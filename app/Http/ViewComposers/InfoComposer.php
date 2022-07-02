<?php
namespace App\Http\ViewComposers;


use App\Repositories\Mysqls\AccountMysql;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class InfoComposer{
    protected $accountMysql;
    public function __construct(AccountMysql $accountMysql)
    {
        $this->accountMysql=$accountMysql;
    }
    public function compose(View $view){
        $id_account=Session::get('admin_id');
        if(isset($id_account)){

            $accounts=$this->accountMysql->findById($id_account);
            $nameUser=!isset($accounts->username) ? 'Admin':$accounts->username;
            return $view->with('info_name',$nameUser);
        }
    
    }
}
?>