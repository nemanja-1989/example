<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Constants\Items;

class ItemsConstants
{
    const ITEMS_CACHE = '/v1/items';
    const ITEMS_URI = 'items';

    public static function itemCache($id) :string {
        return '/v1/items/' . $id;
    }

    public static function itemUri($id) :string {
        return 'items/' . $id;
    }
}