<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{


    public function index()
    {
        $roles = Role::with('permissions')->select('id', 'name', 'guard_name', 'created_at', 'updated_at', 'estadorol')->get(); 
        return response()->json($roles);
    }
    


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:roles,name',
            'permisos' => 'required|array',
            'permisos.*' => 'exists:permissions,id',
        ]);

        try {
            $nuevoRol = Role::create([
                'name' => $request->nombre,
                'guard_name' => 'web', // Asegúrate de ajustar esto según tu configuración
            ]);

            $permissions = Permission::whereIn('id', $request->permisos)->get();
            $nuevoRol->syncPermissions($permissions); // Usar syncPermissions() para sincronizar permisos

            return response()->json(['message' => 'Rol creado con éxito'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el rol', 'error' => $e->getMessage()], 401);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'name' => 'required|string|unique:roles,name,' . $id . ',id',
                'permissions' => 'required|array',
                'permissions.*' => 'exists:permissions,id',
                'estadorol' => 'required|boolean',
            ], [
                'name.required' => 'El nombre del rol es obligatorio.',
                'name.string' => 'El nombre del rol debe ser una cadena de texto.',
                'name.unique' => 'Ya existe un rol con ese nombre.',
                'permissions.required' => 'Debe seleccionar al menos un permiso para el rol.',
                'permissions.array' => 'Los permisos deben ser proporcionados en formato de arreglo.',
                'permissions.*.exists' => 'Uno o más permisos seleccionados son inválidos.',
            ]);

            $rol = Role::findOrFail($id);
            $rol->update([
                'name' => $request->name,
                'estadorol' => $request->estadorol, 
            ]);
            $rol->syncPermissions($request->permissions);

            // Devolver una respuesta de éxito
            return response()->json(['message' => 'Rol actualizado con éxito'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capturar errores de validación y devolver una respuesta de error con el mensaje de validación
            return response()->json(['errors' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            // Capturar otros errores y devolver una respuesta de error
            return response()->json(['message' => 'Error al actualizar el rol', 'error' => $e->getMessage()], 500);
        }
    }
}