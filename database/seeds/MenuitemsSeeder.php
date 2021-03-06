<?php
namespace Database\Seeders;

use App\Highlightedbox;
use App\Highlightedprinter;
use Illuminate\Database\Seeder;

class MenuitemsSeeder extends \Datalytix\Menu\Seeds\MenuitemsSeederBase
{
    protected function buildMenuitemDataset()
    {
        $position = 0;
        $dataset = [
            4 => [
                'position' => ++$position,
                'label' => 'Nyomtatók',
                'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                'url' => null, // we can either use direct url-s, or route names
                'routename' => 'vuecrud_printer_index',
                'iconclass' => 'mdi mdi-printer', // if not null, a <span with this class will be rendered before the label
                'custom_view_name' => null, // optional blade template name if needed
                'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
            8 => [
                'position' => ++$position,
                'label' => 'Bérelhető nyomtatók',
                'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                'url' => null, // we can either use direct url-s, or route names
                'routename' => 'vuecrud_printerrentaloption_index',
                'iconclass' => 'mdi mdi-printer-settings', // if not null, a <span with this class will be rendered before the label
                'custom_view_name' => null, // optional blade template name if needed
                'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
            7 => [
                'position' => ++$position,
                'label' => 'Bérleti konstrukciók',
                'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                'url' => null, // we can either use direct url-s, or route names
                'routename' => 'vuecrud_rentaloption_index',
                'iconclass' => 'mdi mdi-cash-multiple', // if not null, a <span with this class will be rendered before the label
                'custom_view_name' => null, // optional blade template name if needed
                'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
            41 => [
                'position' => ++$position,
                'label' => 'Kijelzők',
                'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                'url' => null, // we can either use direct url-s, or route names
                'routename' => 'vuecrud_display_index',
                'iconclass' => 'mdi mdi-monitor', // if not null, a <span with this class will be rendered before the label
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
                'iconclass' => 'mdi mdi-factory', // if not null, a <span with this class will be rendered before the label
                'custom_view_name' => null, // optional blade template name if needed
                'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
            2 => [
                'position' => ++$position,
                'label' => 'Szöveges tartalmak',
                'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                'url' => null, // we can either use direct url-s, or route names
                'routename' => 'vuecrud_article_index',
                'iconclass' => 'mdi mdi-file-document', // if not null, a <span with this class will be rendered before the label
                'custom_view_name' => null, // optional blade template name if needed
                'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
            21 => [
                'position' => ++$position,
                'label' => 'Tartalom-kategóriák',
                'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                'url' => null, // we can either use direct url-s, or route names
                'routename' => 'vuecrud_articlecategory_index',
                'iconclass' => 'mdi mdi-format-list-bulleted', // if not null, a <span with this class will be rendered before the label
                'custom_view_name' => null, // optional blade template name if needed
                'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
            9 => [
                'position' => ++$position,
                'label' => Highlightedprinter::SUBJECT_NAME_PLURAL,
                'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                'url' => null, // we can either use direct url-s, or route names
                'routename' => 'vuecrud_'.Highlightedprinter::SUBJECT_SLUG.'_index',
                'iconclass' => 'mdi mdi-printer-3d', // if not null, a <span with this class will be rendered before the label
                'custom_view_name' => null, // optional blade template name if needed
                'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
            10 => [
                'position' => ++$position,
                'label' => Highlightedbox::SUBJECT_NAME_PLURAL,
                'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                'url' => null, // we can either use direct url-s, or route names
                'routename' => 'vuecrud_'.Highlightedbox::SUBJECT_SLUG.'_index',
                'iconclass' => 'mdi mdi-home-alert', // if not null, a <span with this class will be rendered before the label
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
                'iconclass' => 'mdi mdi-printer-alert', // if not null, a <span with this class will be rendered before the label
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
            31 => [
                 'position' => ++$position,
                 'label' => 'Diák',
                 'parent_id' => null, // we can have this element be a child of a parent; the id is the key in $dataset
                 'url' => null, // we can either use direct url-s, or route names
                 'routename' => 'vuecrud_slider_index',
                 'iconclass' => 'mdi mdi-projector-screen', // if not null, a <span with this class will be rendered before the label
                 'custom_view_name' => null, // optional blade template name if needed
                 'user_gate' => null, // if set, the item is only rendered if the current user passes a can: check
                 'menuitemtype_id' => 2, //one of the constants in Menuitem; the item can either be a group name or a menu item
                'tag' => 'admin'
            ],
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
        ];

        return $dataset;
    }

}
