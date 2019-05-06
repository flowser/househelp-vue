<?php

namespace App\Listeners;

use App\Events\UserReferred;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Course\Referral\ReferralLink;
use App\Models\Course\Referral\ReferralCommission;

class RewardUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserReferred  $event
     * @return void
     */
    public function handle(UserReferred $event)
    {
        // $vent =
        // UserReferred {#543 ▼
        //     +referralId: "1"
        //     +user: User {#552 ▼
        //       #fillable: array:12 [▶]
        //       #hidden: array:2 [▶]
        //       #dates: array:2 [▶]
        //       #appends: array:1 [▶]
        //       #casts: array:2 [▶]
        //       #connection: "mysql"
        //       #table: "users"
        //       #primaryKey: "id"
        //       #keyType: "int"
        //       +incrementing: true
        //       #with: []
        //       #withCount: []
        //       #perPage: 15
        //       +exists: true
        //       +wasRecentlyCreated: true
        //       #attributes: array:11 [▼
        //         "first_name" => "SIRONGA GIRLS"
        //         "last_name" => "STORES"
        //         "email" => "hhhh@teifinnovate.foundation"
        //         "password" => "$2y$10$T6YUm.Wx0VNHcKANrlfFNuTjYTr1c6HFZCJrmXu2K5gRtRu60/V2u"
        //         "user_type" => "Organisation Director"
        //         "active" => true
        //         "confirmed" => true
        //         "confirmation_code" => "1ea7a52bfbcfc482998fd9193c56a1d3"
        //         "updated_at" => "2019-03-29 12:25:44"
        //         "created_at" => "2019-03-29 12:25:44"
        //         "id" => 8
        $referral = ReferralLink::find($event->referralId);
        if (!is_null($referral)) {
            ReferralCommission::create(['referral_link_id' => $referral->id, 'user_id' => $event->user->id]);

            // $refferal  =
            // "id" => 1
            // "user_id" => 1
            // "organisation_affiliate_id" => null
            // "referral_course_id" => 1 relates to  referral_courses ->course_id
            // "code" => "0bddef3c-5217-11e9-b574-208984f39f26"

            // Example...
            // if ($referral->referral_course_id === '1') {
            //     // User who was sharing link
            //     $provider = $referral->user;
            //     $provider->addCredits(15);
            //     // User who used the link
            //     $user = $event->user;
            //     $user->addCredits(20);
            // }

        }
    }
}
