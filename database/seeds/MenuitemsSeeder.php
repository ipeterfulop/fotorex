<?php

use Illuminate\Database\Seeder;

class MenuitemsSeeder extends \Datalytix\Menu\Seeds\MenuitemsSeederBase
{
    protected function buildMenuitemDataset()
    {
        $position = 0;
        $dataset = [
            1 => [
                 'position' => ++$position,
                 'label' => 'Felhasználók',
                 'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                 'url' => null, // we can either use direct url-s, or route names
                 'routename' => 'vuecrud_user_index',
                 'iconclass' => 'mdi mdi-account', // if not null, a <span with this class will be rendered before the label
                 'custom_view_name' => null, // optional blade template name if needed
                 'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                 'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                 'tag' => 'admin'
            ],
            2 => [
                 'position' => ++$position,
                 'label' => 'Cikkek',
                 'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                 'url' => null, // we can either use direct url-s, or route names
                 'routename' => 'vuecrud_article_index',
                 'iconclass' => 'mdi mdi-file-document', // if not null, a <span with this class will be rendered before the label
                 'custom_view_name' => null, // optional blade template name if needed
                 'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                 'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
            3 => [
                 'position' => ++$position,
                 'label' => 'Üzenetek',
                 'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                 'url' => null, // we can either use direct url-s, or route names
                 'routename' => 'vuecrud_contactmessage_index',
                 'iconclass' => 'mdi mdi-email', // if not null, a <span with this class will be rendered before the label
                 'custom_view_name' => null, // optional blade template name if needed
                 'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                 'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
            4 => [
                'position' => ++$position,
                'label' => 'Termékek',
                'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                'url' => null, // we can either use direct url-s, or route names
                'routename' => 'vuecrud_printer_index',
                'iconclass' => 'mdi mdi-email', // if not null, a <span with this class will be rendered before the label
                'custom_view_name' => null, // optional blade template name if needed
                'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
            5 => [
                'position' => ++$position,
                'label' => 'Gyártók',
                'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                'url' => null, // we can either use direct url-s, or route names
                'routename' => 'vuecrud_manufacturer_index',
                'iconclass' => 'mdi mdi-email', // if not null, a <span with this class will be rendered before the label
                'custom_view_name' => null, // optional blade template name if needed
                'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
            6 => [
                'position' => ++$position,
                'label' => 'Speciális funkciók',
                'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                'url' => null, // we can either use direct url-s, or route names
                'routename' => 'vuecrud_extrafeature_index',
                'iconclass' => 'mdi mdi-email', // if not null, a <span with this class will be rendered before the label
                'custom_view_name' => null, // optional blade template name if needed
                'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
        ];

        return $dataset;
    }

}
