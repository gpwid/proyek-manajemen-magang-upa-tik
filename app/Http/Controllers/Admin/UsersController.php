<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index');
    }

    public function data(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Search Custom
        if ($request->filled('searchbox')) {
            $search = $request->searchbox;
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('aksi', function ($user) {
                $toggleUrl = route('admin.users.status', $user->id);
                $toggleText = $user->status === 'active' ? 'Nonaktifkan' : 'Aktifkan';
                $toggleIcon = $user->status === 'active' ? 'fa-user-slash' : 'fa-user-check';
                $toggleClass = $user->status === 'active' ? 'btn-warning' : 'btn-success';

                $actions = "<div class='flex gap-2'>
                <a href='".route('admin.users.edit', $user->id)."'
                   class='btn btn-sm btn-primary text-white'
                   data-bs-toggle='tooltip'
                   data-bs-placement='top'
                   title='Edit'>
                    <i class='fa-solid fa-pen-to-square'></i> Edit
                </a>
                <a href='".route('admin.users.show', $user->id)."'
                   class='btn btn-sm btn-info text-white'
                   data-bs-toggle='tooltip'
                   data-bs-placement='top'
                   title='Detail'>
                    <i class='fa-solid fa-eye'></i> Detail
                </a>
                <form action='{$toggleUrl}' method='POST' class='d-inline'>
                ".csrf_field().'
                '.method_field('PUT')."
                <button type='submit' class='btn btn-sm {$toggleClass} text-white' title='{$toggleText}'>
                    <i class='fa-solid {$toggleIcon}'></i> {$toggleText}
                </button>
            </form>
            </div>";

                return $actions;
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'nip' => $validated['nip'] ?? null,
            'nisnim' => $validated['nisnim'] ?? null,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function show(User $user): View
    {
        return view('admin.users.detail', compact('user'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'nip' => $validated['nip'] ?? null,
            'nisnim' => $validated['nisnim'] ?? null,
        ];

        // Hanya update password jika diisi
        if (! empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function toggleStatus(User $user): RedirectResponse
    {
        $authUser = Auth::user();
        // Pencegahan agar tidak bisa menonaktifkan diri sendiri
        if ($user->id === $authUser->id) {
            return back()->with('error', 'Anda tidak dapat mengubah status akun Anda sendiri.');
        }

        $newStatus = $user->status === 'active' ? 'inactive' : 'active';
        $user->update(['status' => $newStatus]);

        return redirect()->route('admin.users.index')->with('success', "Status pengguna {$user->name} berhasil diubah menjadi {$newStatus}.");
    }
}
