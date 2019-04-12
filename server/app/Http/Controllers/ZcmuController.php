<?php
/**
 * Created by PhpStorm.
 * User: pkmm
 * Date: 2017/10/14
 * Time: 17:49
 */

namespace App\Http\Controllers;

use App\Manager\NewInfoManager;
use Illuminate\Http\Request;

class ZcmuController extends Controller
{
    public function getNewInfos(Request $request)
    {
        $id = $request->route('id');
        if (!empty($id)) {
            return NewInfoManager::getNewInfoById($id);
        }
        $pageSize = $request->get('page_size', 10);
        $pageNumber = $request->get('page_number', 1);
        return NewInfoManager::getNewInfos($pageSize, $pageNumber);
    }
}
