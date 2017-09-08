<?php
use App\Console\Cltvo\SetSite\CltvoSet;
use Illuminate\Console\Command;

use App\Models\Users\Role;
use App\Models\Users\Permission;

class AssociatePermissionRoleSet extends CltvoSet
{
    /**
     *  Etiqueta a desplegarse para informar al final
     */
    protected $label = 'Associate permissions and roles';

    /**
     *  Nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass()
    {
        return '';
    }

    /**
     *  Valores a ser introducidos en la base
     */
    protected function CltvoGetItems()
    {
        return [
            [
                'role'          => 'super_admin',
                'permissions'   => []
            ],
            [
                'role'          => 'admin',
                'permissions'   => [
                    'admin_access',
                    'system_config',
                    'manage_users',
                    'manage_photos',
                    'associate_photos',
                    'manage_pages_contents',
                    'manage_seo_booster'
                ]
            ]
        ];
    }

    /**
     * Método de introducción de valores
     * @param array     $model_args   Argumentos que definiran el sembrado
     * @param Command   $command      Commando actual
     */
    protected function CltvoSower(array $model_args, Command $command)
    {
        $role = Role::where(['slug' => $model_args['role']])->get()->first();

        if (!$role)
        {
            $command->error($model_args['role'] . ' role not exist.');
            return;
        }

        if($role->isSuperAdmin())
        {
            foreach (Permission::get() as $permission)
            {
                $this->AssociatePermissionAndRole($role, $permission, $command);
            }
        }

        foreach ($model_args['permissions'] as $permission_slug)
        {
            $permission = Permission::where(['slug'=> $permission_slug])->get()->first();

            if (!$permission)
            {
                $command->error($permission_slug . ' permission not exist.');
                return;
            }

            $this->AssociatePermissionAndRole($role, $permission, $command);
        }
    }

    /**
     * Método de introducción de valores
     * @param Role          $role       Rol para asociar
     * @param Permission    $permission Permiso a ser asociado
     * @param Command       $command    Comando actual
     */
    protected function AssociatePermissionAndRole(Role $role, Permission $permission, Command $command)
    {
        if(!$role->permissions()->get()->find($permission))
        {
            if ($role->permissions()->save($permission))
            {
                $command->line('<info>' . $permission->label . ':</info>' . ' successfully associated with ' . $role->label . '.');
            }
            else
            {
                $command->line('<error>' . $permission->label . ':</error>' . ' not successfully associated with ' . $role->label . '.');
            }
        }
        else
        {
            $command->line('<comment>' . $permission->label . ':</comment>' . ' previously associate with ' . $role->label . '.');
        }
    }

}
