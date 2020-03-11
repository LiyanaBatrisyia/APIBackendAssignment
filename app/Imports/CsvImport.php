<?php

namespace App\Imports;

use App\Models\UserModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CsvImport implements ToCollection, WithHeadingRow
{
    /**
     * @var array
     */
    public $result;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows){
        $rowNumber = 0;
        $results = array();
        foreach($rows as $row){
            $rowNumber++;
            $row = $row->toArray();
            $validator = Validator::make($row, UserModel::RULES+['action' => 'required | in:Create,Update,Delete']);
            if( $validator -> fails()){
                $error = $validator->errors();
                $results[] = [$rowNumber, $error];

            }else{
                $action = $row['action'];
                if($action == 'Create' || $action == 'Update'){
                    UserModel::updateOrCreate(['email'    => $row['email']],
                        [
                        'name'     => $row['name'],
                        'gender'   => $row['gender'],
                        'password' => \Hash::make($row['password']),
                        ]);

                    $results[]=[
                        'row' =>  $rowNumber,
                        'message'=>'Request Successful!'
                    ];
                    //$user -> save();
                }
                elseif($action == 'Delete'){
                    $user = UserModel::where('email', $row['email'])->First();
                    $user -> delete();

                    $results[]=[
                        'row' =>  $rowNumber,
                        'message'=>'Delete Successful!'
                    ];
                }
            }
        }
        $this -> result = $results;
    }
}
