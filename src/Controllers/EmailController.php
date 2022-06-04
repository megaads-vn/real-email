<?php

namespace Megaads\RealEmail\Controllers;


use Cassandra\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Request;

class EmailController extends BaseContoller
{
    public function unsubscribeFakeEmail(Request $request)
    {
        $response = $this->getDefaultStatus();
        Log::info('unsubscribeFakeEmail: ' . json_encode($request->all()));
        if ($request->has('email') && $request->has('unsubscribe_to')) {
            $table = $request->get('unsubscribe_to');
            $emailExists = true;
                $emailExists = \RealEmail::setStreamTimeoutWait(20)
                    ->setConnectionTimeout(15)
                    ->setDebug(false)
                    ->setDebugoutput('html')
                    ->setEmailFrom('bachnx2303@gmail.com')
                    ->check($request->get('email'));
            if (!$emailExists) {
                if (Schema::hasTable($table)) {
                    try {
                        $columns = Schema::getColumnListing($table);
                        $requestFields = $request->all();
                        $insertParams = [];
                        foreach ($columns as $item) {
                            if (isset($requestFields[$item])) {
                                $insertParams[$item] = $requestFields[$item];
                            } else if ($item == 'created_at' || $item == 'updated_at') {
                                $insertParams[$item] = new \DateTime();
                            }
                        }
                        DB::table($table)->insert($insertParams);
                        $response  = $this->getSuccessStatus(['exists' => $emailExists, 'email' => $request->get('email')]);
                    } catch (\Exception $ex) {
                        $response['message'] = 'Have error when inserting. Maybe duplicate entry!';
                    }
                }
            }
        } else {
            $response['message'] = 'Invalid parameter(s)';
        }
        return response()->json($response);
    }


}