<?php
require_once __DIR__ . '/Model.php';

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';
}
