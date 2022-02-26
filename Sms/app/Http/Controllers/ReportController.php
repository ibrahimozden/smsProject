<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ReportController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/reports",
     *      operationId="getReportList",
     *      tags={"Reports{Get}"},
     *      security={{"bearer_token":{}}},
     *      summary="Get list of Reports",
     *      description="Reports of sent messages of the logged in user",
     * 
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     * *    
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function index()
    {
        return $this->user
            ->reports()
            ->get();
    }
    //filter date

    /**
     * @OA\Get(
     *      path="/filter_reports",
     *      operationId="getReportList",
     *      tags={"DateFilterReports{Get}"},
     *      security={{"bearer_token":{}}},
     *      description="Reports between two dates of messages sent by the logged in user",
     * 
     *  @OA\Parameter(
     *      name="start_date",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  *  @OA\Parameter(
     *      name="end_date",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function filter_report(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)
            ->toDateTimeString();

        $end_date = Carbon::parse($request->end_date)
            ->toDateTimeString();

        return $this->user->reports()->whereBetween('sending_time', [$start_date, $end_date])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     ** path="/reports",
     *   tags={"Sms{Post}"},
     *   summary="Sms Post",
     *   operationId="smspost",
     *   security={{"bearer_token":{}}},
     *   description="User sends messages to customers", 
     * 
     *   @OA\Parameter(
     *      name="number",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="message",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function store(Request $request)
    {
        //Validate data
        $data = $request->only('number', 'message');
        Validator::make($data, [
            'number' => 'required|string',
            'message' => 'required|string',

        ]);
        //Request is valid, create new report
        $report = $this->user->reports()->create([
            'number' => $request->number,
            'message' => $request->message,

        ]);

        //Rrport created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Sms created successfully',
            'data' => $report
        ], Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *      path="/reports/{id}",
     *      operationId="getReportDetail",
     *      tags={"ReportsDetail{id}"},
     *      summary="Get list of Reports detail",
     *      description="Message details of a report, e.g. when it was sent",
     *      security={{"bearer_token":{}}},
     * 
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *           @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function show($id)
    {
        $report = $this->user->reports()->find($id);

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, report not found.'
            ], 400);
        }

        return $report;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //Validate data
        $data = $request->only('number', 'message');
        Validator::make($data, [
            'number' => 'required|string',
            'message' => 'required|string',

        ]);


        //Request is valid, update report
        $report = $report->update([
            'number' => $request->number,
            'message' => $request->message,

        ]);

        //Report updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Report updated successfully',
            'data' => $report
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Delete(
     *      path="/delete/{report}",
     *      operationId="getReportDetail",
     *      tags={"ReportsDelete{id}"},
     *      summary="Get list of Reports detail",
     *      description="Deletes a report by id number",
     *      security={{"bearer_token":{}}},
     * 
     *  @OA\Parameter(
     *      name="report",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *           @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return response()->json([
            'success' => true,
            'message' => 'Report deleted successfully'
        ], Response::HTTP_OK);
    }
}
