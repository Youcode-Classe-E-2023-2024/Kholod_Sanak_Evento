<?php

namespace App\Http\Controllers;

use App\Events\UserSubscribed;
use App\Models\EmailList;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;


//use Symfony\Component\Mime\Message;
use Symfony\Component\Mime\Part\TextPart;
//use Symfony\Component\Mime\Part\HtmlPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;





class NewsletterController extends Controller
{
    public function index(){
        $newsletters = Newsletter::orderBy('created_at', 'desc')->paginate(6);
        return view('writer.template', compact('newsletters'));

    }


    public function view(){
        $newsletters = Newsletter::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.template', compact('newsletters'));
    }

    public function subscribe(Request $request){
        $request->validate([
            'email'=> 'required|unique:emaillists,email'
        ]);

        event(new UserSubscribed($request->input('email')));

        return back();
    }

    public function unsubscribe1(Request $request)
    {
        // Validate the request data
        $request->validate([
            'token' => 'required|string',
        ]);

        // Find the subscriber by token
        $subscriber = EmailList::where('unsubscribe_token', $request->token)->first();

        if ($subscriber) {
            $subscriber->status = 'unsub';
            $subscriber->save();

            return redirect()->back()->with('success', 'You have successfully unsubscribed.');
        }
        return redirect()->back()->with('error', 'Subscriber not found.');
    }

    public function unsubscribe($token)
    {
        $subscriber = EmailList::where('unsubscribe_token', $token)->first();

        if ($subscriber) {
            $subscriber->status = 'unsub';
            $subscriber->save();
            return redirect()->route('unsubscribe.success')->with('success', 'You have been unsubscribed successfully.');
        } else {
            return redirect()->route('unsubscribe.error')->with('error', 'Invalid unsubscribe token.');
        }
    }


    public function saveAdmin(Request $request)
    {
        //dd($request);
        $userId = Auth::id();
        //dd($userId);

        // Validate the request data
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
        ]);

        // Create the newsletter in the database
        Newsletter::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            "user_id" => $userId,
        ]);

        // Redirect to a success page or return a response as needed
        return redirect()->route('templates')->with('success', 'Newsletter created successfully');
    }


    public function save(Request $request)
    {
        //dd($request);
        $userId = Auth::id();
        //dd($userId);

        // Validate the request data
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
        ]);

        // Create the newsletter in the database
         Newsletter::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            "user_id" => $userId,
        ]);

        // Redirect to a success page or return a response as needed
        return redirect()->route('template')->with('success', 'Newsletter created successfully');
    }


    public function deleteNewsletter($id)
    {
        $newsletter = Newsletter::findOrFail($id);

        // Soft delete the newsletter
        $newsletter->delete();

        // Redirect or return a response as needed
        return redirect()->route('templates')->with('success', 'Newsletter deleted successfully');
    }

    public function sendAdmin($id)
    {
        $newsletter = Newsletter::findOrFail($id);

        $subscribers = EmailList::where('status', 'sub')->get();

        foreach ($subscribers as $subscriber) {
            $unsubscribeToken = Str::random(100);
            $subscriber->unsubscribe_token = $unsubscribeToken;
            $subscriber->save();

            $unsubscribeLink = route('unsubscribe', ['token' => $unsubscribeToken]);

            $this->sendNewsletterToSubscriber($newsletter, $subscriber, $unsubscribeLink);
        }

        $newsletter->status ='sent';
        $newsletter->save();

        return redirect()->route('/templates')->with('success', 'Newsletter sent successfully.');
    }


    public function send($id)
    {
        $newsletter = Newsletter::findOrFail($id);

        $subscribers = EmailList::where('status', 'sub')->get();

        foreach ($subscribers as $subscriber) {
            $unsubscribeToken = Str::random(100);
            $subscriber->unsubscribe_token = $unsubscribeToken;
            $subscriber->save();

            $unsubscribeLink = route('unsubscribe', ['token' => $unsubscribeToken]);

            $this->sendNewsletterToSubscriber($newsletter, $subscriber, $unsubscribeLink);
        }

        $newsletter->status ='sent';
        $newsletter->save();

        return redirect()->route('/template')->with('success', 'Newsletter sent successfully.');
    }




    private function sendNewsletterToSubscriber($newsletter, $subscriber, $unsubscribeLink)
    {
        $recipientEmail = $subscriber->email;
        $textContent = strip_tags($newsletter->contenu);

        try {
            Mail::send([], [], function(Message $message) use ($recipientEmail, $textContent, $unsubscribeLink) {
                $message->to($recipientEmail);
                $message->subject('Your Newsletter Subscription');
                $message->html($textContent . "<br><a href=\"$unsubscribeLink\">Unsubscribe</a>");
            });

            Log::info('Newsletter sent successfully to: ' . $recipientEmail);
        } catch (\Exception $e) {
            Log::error('Failed to send newsletter to: ' . $recipientEmail . '. Error: ' . $e->getMessage());
        }
    }


    public function display()
    {
        return view('success');
    }

}
