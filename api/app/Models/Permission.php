<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    const CAN_CREATE_USER = 'can_create_user';
    const CAN_EDIT_USER = 'can_edit_user';
    const CAN_DELETE_USER = 'can_delete_user';
    const CAN_VIEW_USER = 'can_view_user';
    const CAN_VIEW_REPORTS = 'can_view_reports';
    const CAN_VIEW_COMBINED_REPORTS = 'can_view_combined_reports';
    const CAN_VIEW_SHOPS = 'can_view_shops';
    const CAN_CREATE_SHOP = 'can_create_shop';
    const CAN_EDIT_SHOP = 'can_edit_shop';
    const CAN_DELETE_SHOP = 'can_delete_shop';
}
