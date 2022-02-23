<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use App\Models\Enquiry;
use App\Models\FollowUpEntry;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnquiryController extends Controller
{
    public function addLead(Request $request)
    {


        $request->validate([


            'name'  => 'required',
            // 'email' => 'required',
            'mobile'  => 'required',
            'selectedBrand' => 'required',
            'selectedModel'  => 'required',




        ]);

        if ($request->source_of_lead == 'Reference') {

            $request->validate([

                'referee_details' => 'required',

            ]);
        }

        $enquiry = new Enquiry();
        $enquiry->user_id = Auth::user()->id;
        $enquiry->name = strtoupper($request->name);
        $enquiry->email = $request->email;
        $enquiry->mobile = $request->mobile;
        $enquiry->enq_vehicle_reg_no = $request->selected_reg_no;

        $enquiry->enq_brand = $request->selectedBrand;
        $enquiry->enq_model = $request->selectedModel;
        $enquiry->source_of_lead = $request->source_of_lead;
        $enquiry->referee_details = $request->referee_details;


        $enquiry->save();
        return 'success';
    }



    public function getEnquiries(Request $request)
    {

        $enquiry = Enquiry::with('brands', 'models')->orderBy('id', 'DESC');

        if ($request->source) {

            $enquiry->where('source_of_lead', '=', $request->source);
        }
        if ($request->priority) {

            $enquiry->where('priority_status', '=', $request->priority);
        }

        if ($request->lead_status == 'Booked') {

            $enquiry->where('lead_status', '=', 1);
        }
        if ($request->lead_status == 'Dropped') {

            $enquiry->where('lead_status', '=', 2);
        }
        if ($request->lead_status == '') {

            $enquiry->where('lead_status', '=', 0);
        }


        return $enquiry->get();
    }



    public function addCallEntry(Request $request)
    {


        $request->validate([

            'callDate' => 'required',
            'timeHour' => 'required',
            'timeMin' => 'required',
            'timeAmPm' => 'required',
            'callStatus' => 'required',

        ]);
        if ($request->callStatus == 'Connected') {
            $request->validate([
                'leadPriority' => 'required',
            ]);
        }

        $leadFollow = new FollowUpEntry();

        $leadFollow->user_id = Auth::user()->id;
        $leadFollow->enq_id = $request->id;
        $leadFollow->call_date = $request->callDate;
        $leadFollow->time = $request->timeHour . ':' . $request->timeMin . ' ' . $request->timeAmPm;
        $leadFollow->call_status = $request->callStatus;
        $leadFollow->remarks = $request->remarks;

        if ($request->leadPriority == 'High') {

            $leadFollow->priority_status = 1;
            $leadFollow->save();
        }
        if ($request->leadPriority == 'Medium') {
            $leadFollow->priority_status = 2;
            $leadFollow->save();
        }
        if ($request->leadPriority == 'Low') {
            $leadFollow->priority_status = 3;
            $leadFollow->save();
        }
        $leadFollow->save();


        if ($request->id) {

            $vehicleEnq = Enquiry::find($request->id);
            if ($request->leadPriority == 'High') {

                $vehicleEnq->priority_status = 1;
                $vehicleEnq->save();
            }
            if ($request->leadPriority == 'Medium') {
                $vehicleEnq->priority_status = 2;
                $vehicleEnq->save();
            }
            if ($request->leadPriority == 'Low') {
                $vehicleEnq->priority_status = 3;
                $vehicleEnq->save();
            }
        }

        if ($leadFollow->save()) {
            return 'success';
        }
    }



    //follow-up-history
    public function getHistory(Request $request)
    {
        $followUpHistory = Enquiry::with(['getFollowUp', 'brands', 'models' => function ($query) {
            $query->orderBy('id', 'DESC');
        }])->where('id', '=', $request->enq_id)->get();
        return $followUpHistory;
    }


    public function getVehicleForBooking()
    {
        $vehiclelist = Purchase::with('brands', 'models')->where('vehicle_status', '=', 1)->orderBy('id', 'DESC')->get();
        return $vehiclelist;
    }


    public function addConvertion(Request $request)
    {

        $request->validate([
            'convertion_status' => 'required',
        ]);

        //Convertion_status:1->BOOKED
        if ($request->convertion_status == 1) {
            $request->validate([
                'vehicle_id' => 'required',
                'total_vehicle_price' => 'required',
                'enq_id' => 'required',
                'booking_amount' => 'required',
            ]);
        }

        //Convertion_status:2->DROPPED
        if ($request->convertion_status == 2) {
            $request->validate([
                'remarks' => 'required',
            ]);
        }

        if ($request->enq_id) {
            $convert = Enquiry::find($request->enq_id);
            if ($convert->lead_status == '1') {
                return 'already_booked';
            }

            if ($convert->lead_status == '2') {
                return 'already_dropped';
            }

            if ($request->convertion_status == '1') {
                $convert->lead_status = '1';
                $convert->conversion_remarks = $request->remarks;
                $convert->save();


                $booked = new BookingList();
                $booked->user_id = Auth::user()->id;
                $booked->vehicle_id = $request->vehicle_id;
                $booked->enq_id = $request->enq_id;
                $booked->customer_name = $request->customer_name;
                $booked->booking_amount = $request->booking_amount;

                $booked->total_payment_recieved = $request->booking_amount;
                $booked->sale_price = $request->total_vehicle_price;

                if ($request->remarks) {
                    $booked->remarks = $request->remarks;
                }
                $booked->save();
            }


            if ($request->convertionStatus == '2') {
                $convert->lead_status = '2';
                $convert->remarks = $request->remarks;
                $convert->save();
            }

            if ($convert->save()) {
                return 'success';
            }
        }
    }



    public function addEnquiry(Request $request){
        $request->validate([


            'name'  => 'required',
            // 'email' => 'required',
            'mobile'  => 'required',
            'selectedBrand' => 'required',
            'selectedModel'  => 'required',




        ]);

        $enquiry = new Enquiry();
        $enquiry->user_id = 0;
        $enquiry->name = strtoupper($request->name);
        $enquiry->email = $request->email;
        $enquiry->mobile = $request->mobile;
        $enquiry->enq_vehicle_reg_no = $request->selected_reg_no;

        $enquiry->enq_brand = $request->selectedBrand;
        $enquiry->enq_model = $request->selectedModel;
        $enquiry->source_of_lead = $request->source_of_lead;


        $enquiry->save();
        return 'success';
    }
}
