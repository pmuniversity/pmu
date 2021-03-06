<?php
/*
 * NOTICE OF LICENSE
 *
 * Part of the Rinvex Repository Package.
 *
 * This source file is subject to The MIT License (MIT)
 * that is bundled with this package in the LICENSE file.
 *
 * Package: Rinvex Repository Package
 * License: The MIT License (MIT)
 * Link:    https://rinvex.com
 */
namespace App\Exceptions;

use Exception;

class RepositoryException extends Exception
{
    public static function listNotFound($list, $object)
    {
        return new static('Given list "' . $list . '" not found in ' . get_class($object) . ' class');
    }
}