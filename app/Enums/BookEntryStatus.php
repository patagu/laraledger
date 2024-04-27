<?php
namespace App\Enums;

enum BookEntryStatus: string {
    case active = 'active';
    case archived = 'archived';
    case reconciled = 'reconciled';
}
