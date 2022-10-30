<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Permission;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->command->info('Delete semua tabel menu');
      Model::unguard();
      Menu::truncate();
      $this->menuAcl();
      // $this->command->info('Menu Seeder Complete');
    }

    private function menuAcl(){
      $this->command->info('Menu ACL Seeder');
      $permission = Permission::firstOrNew(array(
        'name'=>'read-acl-menu'
      ));
      $permission->display_name = 'Read ACL Menus';
      $permission->save();
      $menu = Menu::firstOrNew(array(
        'name'=>'ACL',
        'permission_id'=>$permission->id,
        'ordinal'=>1,
        'parent_status'=>'Y'
      ));
      $menu->icon = 'md-settings';
      $menu->save();

          //create SUBMENU master
         $permission = Permission::firstOrNew(array(
           'name'=>'read-users',
         ));
         $permission->display_name = 'Read Users';
         $permission->save();

         $submenu = Menu::firstOrNew(array(
           'name'=>'Users',
           'parent_id'=>$menu->id,
           'permission_id'=>$permission->id,
           'ordinal'=>2,
           'parent_status'=>'N',
           'url'=>'user',
           )
         );
         $submenu->save();

         $permission = Permission::firstOrNew(array(
           'name'=>'read-permissions',
         ));
         $permission->display_name = 'Read Permissions';
         $permission->save();

         $submenu = Menu::firstOrNew(array(
           'name'=>'Permissions',
           'parent_id'=>$menu->id,
           'permission_id'=>$permission->id,
           'ordinal'=>2,
           'parent_status'=>'N',
           'url'=>'permission',
           )
         );
         $submenu->save();

         $permission = Permission::firstOrNew(array(
           'name'=>'read-menus',
         ));
         $permission->display_name = 'Read Menus';
         $permission->save();

         $submenu = Menu::firstOrNew(array(
           'name'=>'Menus',
           'parent_id'=>$menu->id,
           'permission_id'=>$permission->id,
           'ordinal'=>2,
           'parent_status'=>'N',
           'url'=>'menu',
           )
         );
         $submenu->save();

         $permission = Permission::firstOrNew(array(
            'name' => 'read-roles',
        ));
        $permission->display_name = 'Read Roles';
        $permission->save();

        $submenu = Menu::firstOrNew(array(
            'name' => 'Roles',
            'parent_id' => $menu->id,
            'permission_id' => $permission->id,
            'ordinal' => 2,
            'parent_status' => 'N',
            'url' => 'role',
            )
          );
        $submenu->save();
    }


}
