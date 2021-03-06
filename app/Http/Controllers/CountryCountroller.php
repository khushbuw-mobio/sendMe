<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\CountryRepository;
use App\Services\CountryManagement;
use App\Http\Requests\CountryRequest;
use Throwable;
use Illuminate\Support\Facades\Log;

class CountryCountroller extends Controller
{
    public $country_repo;
    public $class;
    public function __construct(CountryRepository $country_repo,CountryManagement $class)
    {
        $this->country_repo = $country_repo;
        $this->class=$class;
    }

    /**
    * get data from country
    * @author Khushbu Waghela
    */
    public function index()
    {
        try{
        return $this->country_repo->all_record();
        }catch(Throwable $e){
            return Log::error($e->getMessage);
        }
    }

    /**
    * @param $request
    * add new country 
    * @author Khushbu Waghela
    */
    public function insertCountry(CountryRequest $request)
    {
        try{
        $insertFields=[
            'name'=>$request->name,
            'code'=>$request->code,
        ];
        $result=$this->class->insertRecord($insertFields);
        return $result;
        }catch(Throwable $e){
            return Log::error($e->getMessage);
        }
    }

    /**
    * @param $request
    * edit existing country
    * @author Khushbu Waghela
    */
    public function updateCountry(Request $request)
    {
        try{
        $update=[
            'id'=>$request->id,
            'name'=>$request->name,
            'code'=>$request->code,
        ];
        $result=$this->class->updateRecord($update);
        return $result;
        }catch(Throwable $e){
            return Log::error($e->getMessage);
        }
    }

    /**
    * @param $id
    * delete existing country
    * @author Khushbu Waghela
    */
    public function deleteCountry(Request $request)
    {
        try{
        $result=$this->class->deleteRecord($request['id']);
        return $result;
        }catch(Throwable $e){
            return Log::error($e->getMessage);
        }
    }
}
