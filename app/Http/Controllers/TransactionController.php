<?php

namespace App\Http\Controllers;

use App\Models\ConnectedTrans;
use App\Models\Department;
use App\Models\User;
use App\Models\Importance;
use App\Models\Transaction;
use App\Models\File;
use Illuminate\Http\Request;
use App\Models\Incoming;
use App\Models\Inside;
use App\Models\Outgoing;
use App\Models\TransStatus;
use App\Models\TransType;
use App\Models\TransHistory;
use App\Models\Secret;
use App\Models\UserTransStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TransactionReferr;
use Ramsey\Uuid\Type\Integer;
use RealRashid\SweetAlert\Facades\Alert;


class TransactionController extends Controller
{

    public function index()
    {

        return Transaction::where('type_type', '=', 'App\Models\Inside')->get();
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Transaction $transaction)
    {
        $files = File::where('transaction_id', '=', $transaction->id)->get();
        $connectedTrans = ConnectedTrans::where('transaction1_id', '=', $transaction->id)
            ->orWhere('transaction2_id', '=', $transaction->id)
            ->get();

        //add to transaction history
        $transHistory = new TransHistory();
        $transHistory->date = Carbon::now();
        $transHistory->description = "show transaction details";
        $transHistory->transaction_id = $transaction->id;
        $transHistory->user_id = auth()->user()->id;
        $transHistory->action_id = 6; ////show action
        $transHistory->save();

        return view('transactions.showTransaction', compact('transaction', 'connectedTrans', 'files'));
    }


    public function edit(Transaction $transaction)
    {
        $transTypes = null;
        $transStatus = TransStatus::all();
        $departments = Department::all();
        $secrets = Secret::all();
        $importances = Importance::all();

        if ($transaction->type_type == 'App\Models\Inside') {
            $transTypes = TransType::where('type', '=', 'داخلية')->get();
            return view('transactions.editInsideTrans', compact('transTypes', 'transStatus', 'departments', 'secrets', 'importances', 'transaction'));
        } elseif ($transaction->type_type == 'App\Models\Incoming') {
            $transTypes = TransType::where('type', '=', 'وارد')->get();
            return view('transactions.editIncomingTrans');
        } else {
            $transTypes = TransType::where('type', '=', 'صادر')->get();
            return view('transactions.editOutgoingTrans');
        }
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->type_type == 'App\Models\Inside') {
            $transaction = Transaction::find($transaction->id);

            /// transaction Type
            $inside = Inside::find($transaction->type_id);
            $inside->inside_management = $request->trans_depart;
            $inside->save();

            //transaction data
            $transaction->subject = $request->subject;
            $transaction->trans_type_id = $request->type;
            $transaction->trans_status_id = $request->status;
            $transaction->secret_id = $request->secret;
            $transaction->importance_id = $request->importance;
            $transaction->save();



            //add transaction action to transaction History 'description','date','transaction_id', 'action_id', 'user_id',
            $transHistory = new TransHistory();
            $transHistory->date = Carbon::now();
            $transHistory->description = "update Transaction info";
            $transHistory->transaction_id = $transaction->id;
            $transHistory->user_id = auth()->user()->id;
            $transHistory->action_id = 3;  ////// update Action
            $transHistory->save();


            if ($transaction->save()) {
                Alert::success('', __('transaction.success_message'));
                return redirect()->back();
            } else {
                Alert::error('', __('transaction.error_message'));
                return redirect()->back();
            }
        } elseif ($transaction->type_type == 'App\Models\Incoming') {
        } else {
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function destroy(Transaction $transaction)
    {
        //
    }

    //Inside Transactions
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function createInside()
    {
        $transTypes = TransType::where('type', '=', 'inside')->get();
        $transStatus = TransStatus::all();
        $departments = Department::all();
        $secrets = Secret::all();
        $importances = Importance::all();
        return view('transactions.createInside', compact('transTypes', 'transStatus', 'departments', 'secrets', 'importances'));
    }

    public function storeInside(Request $request)
    {
        $transaction = new Transaction();
        $year=Carbon::now()->year;
        $max=Transaction::max('number');
       
        if ($max==null) {
          $number=$year.'-'.'1';
         
        } else {
           $tempStr=substr($max,5);
           $num= (int)$tempStr;
           $num=$num+1;
           $number=$year.'-'.$num;
        }
        

        /// transaction Type
        $inside = new Inside();
        $inside->inside_management = $request->trans_depart;
        $inside->save();
        $transaction->type()->associate($inside);

        //transaction number
        $transaction->number = $number;

        //transaction data
        $transaction->subject = $request->subject;
        $transaction->trans_type_id = $request->type;
        $transaction->trans_status_id = $request->status;
        $transaction->user_id = auth()->user()->id;
        $transaction->secret_id = $request->secret;
        $transaction->importance_id = $request->importance;
        $transaction->save();



        //add transaction action to transaction History 'description','date','transaction_id', 'action_id', 'user_id',
        $transHistory = new TransHistory();
        $transHistory->date = Carbon::now();
        $transHistory->description = "create new inside Transaction";
        $transHistory->transaction_id = $transaction->id;
        $transHistory->user_id = auth()->user()->id;
        $transHistory->action_id = 1; ///create Action
        $transHistory->save();

        // create new user Transaction Status
        $userTransStatus = new UserTransStatus();
        $userTransStatus->user_id = auth()->user()->id;
        $userTransStatus->transaction_id = $transaction->id;
        $userTransStatus->processed = 0;
        $userTransStatus->save();


        if ($transaction->save()) {
            Alert::success(__('transaction.success_message'), __('transaction.number').'='.$number);
            return redirect()->route('user/transactions/out');
        } else {
            Alert::error('', __('transaction.error_message'));
            return redirect()->back();
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///user transaction
    public function userTransactionout()
    {
        $users = User::all();
        $transactions = Transaction::where('user_id', '=', auth()->user()->id)->paginate(8);
        return view('transactions.userTransOut', compact('transactions', 'users'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function userTransactionIn()
    {
        $transactions = new \Illuminate\Database\Eloquent\Collection;
        $referrType = new \Illuminate\Database\Eloquent\Collection;
        $referrFrom = new \Illuminate\Database\Eloquent\Collection;
        $user = auth()->user();

        foreach ($user->notifications as $notification) {
            if ($notification->read_at == null) {
                /////we must add condition to check notification type ""
                $id = $notification['data']['transaction_id'];
                $trans = Transaction::find($id);
                $transactions->push($trans);
                $referrFrom->push($notification['data']['referr_from']);
                $referrType->push($notification['data']['referr_type']);
            }
        }
        return view('transactions.userTransIn', compact('transactions', 'referrType', 'referrFrom'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function userTranProcessing()
    {
        $transactions = new \Illuminate\Database\Eloquent\Collection;
        $referrType = new \Illuminate\Database\Eloquent\Collection;
        $users = User::all();
        $user = auth()->user();

        foreach ($user->notifications as $notification) {
            if ($notification->read_at != null) {
                $id = $notification['data']['transaction_id'];
                $trans = Transaction::find($id);
                $max = UserTransStatus::where('user_id', '=', $user->id)
                    ->where('transaction_id', '=', $id)
                    ->max('created_at');
                $userTransStatus = UserTransStatus::where('user_id', '=', $user->id)
                    ->where('transaction_id', '=', $id)
                    ->where('created_at', '=', $max)
                    ->first();
                if ($userTransStatus->processed == 0) {
                    $transactions->push($trans);
                    $referrType->push($notification['data']['referr_type']);
                }
            }
        }
        return view('transactions.userTransProcessing', compact('transactions', 'referrType', 'users'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //transactions referr transactionReferr
    public function transactionReferr(Request $request)
    {
        $transaction = Transaction::find($request->transId);
        //add to transaction history
        $transHistory = new TransHistory();
        $transHistory->date = Carbon::now();
        $transHistory->description = $request->description;
        $transHistory->transaction_id = $transaction->id;
        $transHistory->user_id = auth()->user()->id;
        $transHistory->action_id = 2; ////referr action
        $transHistory->save();

        //send notification transaction referr base
        if ($request->to_user_base != null) {
            $base_to_users = new \Illuminate\Database\Eloquent\Collection;
            foreach ($request->to_user_base as $id) {
                $user = User::find($id);
                $base_to_users->push($user);
                // create new user Transaction Status
                $userTransStatus = new UserTransStatus();
                $userTransStatus->user_id = $user->id;
                $userTransStatus->transaction_id = $transaction->id;
                $userTransStatus->processed = 0;
                $userTransStatus->save();
            }
            $transData = [
                'transaction_id' => $transaction->id,
                'referr_from' => auth()->user()->name,
                'referr_type' => __('transaction.referr_base'),
            ];
            Notification::send($base_to_users, new TransactionReferr($transData));
        }

        //send notification transaction referr image
        if ($request->to_user_image != null) {
            $image_to_users = new \Illuminate\Database\Eloquent\Collection;
            foreach ($request->to_user_image as $id) {
                $user = User::find($id);
                $image_to_users->push($user);
                // create new user Transaction Status
                $userTransStatus = new UserTransStatus();
                $userTransStatus->user_id = $user->id;
                $userTransStatus->transaction_id = $transaction->id;
                $userTransStatus->processed = 0;
                $userTransStatus->save();
            }
            $transData = [
                'transaction_id' => $transaction->id,
                'referr_from' => auth()->user()->name,
                'referr_type' => __('transaction.referr_image'),
            ];
            Notification::send($image_to_users, new TransactionReferr($transData));
        }



        return redirect()->back();
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function transactionRecieve(Request $request, $id)
    {
        $user = auth()->user();
        foreach ($user->notifications as $notification) {
            if ($notification['data']['transaction_id'] == $id) {
                $notification->read_at = Carbon::now();
                $notification->save();
            }
        }

        if ($notification->save()) {
            Alert::success('', __('transaction.success_message'));
            return redirect()->back();
        } else {
            Alert::error('', __('transaction.error_message'));
            return redirect()->back();
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function transactionProcessed(Request $request, $id)
    {
        $user = auth()->user();
        $max = UserTransStatus::where('user_id', '=', $user->id)
            ->where('transaction_id', '=', $id)
            ->max('created_at');
        $userTransStatus = UserTransStatus::where('user_id', '=', $user->id)
            ->where('transaction_id', '=', $id)
            ->where('created_at', '=', $max)
            ->first();

        $userTransStatus->processed = 1;
        $userTransStatus->save();

        if ($userTransStatus->save()) {
            Alert::success('', __('transaction.success_message'));
            return redirect()->back();
        } else {
            Alert::error('', __('transaction.error_message'));
            return redirect()->back();
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function transactionConnect(Request $request, $id)
    {
        $connectedTrans = ConnectedTrans::where('transaction1_id', '=', $id)
            ->orWhere('transaction2_id', '=', $id)
            ->get();
        $transactions = Transaction::all();
        return view('transactions.connectedTrans', compact('connectedTrans', 'id', 'transactions'));
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function transactionConnectStore(Request $request, $id)
    {
        /////// connect transaction
        $connectedTrans = new ConnectedTrans();
        $connectedTrans->transaction1_id = $id;
        $connectedTrans->transaction2_id = $request->transNumber;
        $connectedTrans->connect_type = $request->connectType;
        $connectedTrans->save();

        //add to transaction history
        $transHistory = new TransHistory();
        $transHistory->date = Carbon::now();
        $transHistory->description = "connect transaction note";
        $transHistory->transaction_id = $id;
        $transHistory->user_id = auth()->user()->id;
        $transHistory->action_id = 7; ////connect action
        $transHistory->save();

        return redirect()->back();
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function transactionDisConnect(Request $request, $id)
    {
        /////// connect transaction
        $connectedTrans = ConnectedTrans::find($id);
        $connectedTrans->delete();

        return redirect()->back();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function transactionGiveOpinion(Request $request)
    {
        //add to transaction history
        $transHistory = new TransHistory();
        $transHistory->date = Carbon::now();
        $transHistory->description = $request->description;
        $transHistory->transaction_id = $request->transID;
        $transHistory->user_id = auth()->user()->id;
        $transHistory->action_id = 8; ////give opinion action
        $transHistory->save();

        return redirect()->back();
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function transactionClose(Request $request, $id)
    {
        //add to transaction history
        $transHistory = new TransHistory();
        $transHistory->date = Carbon::now();
        $transHistory->description = "close Transaction description";
        $transHistory->transaction_id = $id;
        $transHistory->user_id = auth()->user()->id;
        $transHistory->action_id = 9; ////close action
        $transHistory->save();

        //change Transaction status
        $status = TransStatus::where('status', '=', 'مغلقة')->first();
        $transaction = Transaction::find($id);
        $transaction->trans_status_id = $status->id;
        $transaction->save();

        if ($transaction->save()) {
            Alert::success('', __('transaction.success_message'));
            return redirect()->back();
        } else {
            Alert::error('', __('transaction.error_message'));
            return redirect()->back();
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function transactionFile(Request $request, $id)
    {
        $files = File::where('transaction_id', '=', $id)->get();
        return view('transactions.files', compact('files', 'id'));
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function transactionFileStore(Request $request, $id)
    {
        ///////move file to attachments folder
        $newFile = null;
        $filedoc = $request->path;
        $newFile = time() . $filedoc->getClientOriginalName();
        $filedoc->move('attachments/', $newFile);
        $path = 'attachments/' . $newFile;

        /////// add new file transaction
        $file = new File();
        $file->type = $request->type;
        $file->path = $path;
        $file->transaction_id = $id;
        $file->user_id = auth()->user()->id;
        $file->save();

        //add to transaction history
        $transHistory = new TransHistory();
        $transHistory->date = Carbon::now();
        $transHistory->description = "connect transaction note";
        $transHistory->transaction_id = $id;
        $transHistory->user_id = auth()->user()->id;
        $transHistory->action_id = 4; ////add file action
        $transHistory->save();

        return redirect()->back();
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function transactionFileDetach(Request $request, $id)
    {
        /////// file transaction
        /////// must remove file from public folder
        $file = File::find($id);
        $file->delete();

        return redirect()->back();
    }

    ///////////track///////////////////////////////////////////////////////////////////////////////////
    public function transactionTrack(Request $request)
    {
        $trackedTrans = null;
        return view('transactions.trackedTrans', compact('trackedTrans'));
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    public function transactionSearch(Request $request)
    {

        $transaction = Transaction::where('number', '=', $request->number)
            ->first();


        if ($transaction!=null) {
            $trackedTrans = TransHistory::where('transaction_id', '=', $transaction->id)
            ->get();
            return view('transactions.trackedTrans', compact('trackedTrans'));

        } else {
            $trackedTrans = null;
            Alert::error('', 'لا يوجد معاملة يهذا الرقم');
            return redirect()->route('transaction/tracked');
        }
    
       

        
    }
}
