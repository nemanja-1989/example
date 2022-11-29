<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Constants\Items;

class ItemsConstants
{
    const ITEMS = '/v1/items';

    public static function item($id) :string {
        return '/v1/items/' . $id;
    }
}