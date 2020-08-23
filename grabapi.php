<?php
    namespace map;


    //      cronjob on server for everynight of data grab,
    //      e.g.
    //
    use EQ\Action;
    use EQ\EarthQuart;

    class GrabApi extends Action {

        public function __construct()
        {
            $endtime = time();
            $starttime = time() - 86400;

            $getjsonurl = 'https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&starttime=' .date('Y-m-d', $starttime).'T'.date('H:i:s', $starttime).'&endtime='.date('Y-m-d', $endtime).'T'.date('H:i:s', $endtime);

            $jsoncontent = file_get_contents($getjsonurl);

            if(!$jsoncontent) {
                exit();
            }
            $var = json_decode($jsoncontent);
            $feature = $var->features;

            foreach ($feature as $key=>$_v) {


                $grabdata =     new \EQ\EarthQuart();
                $grabdata->event_type   =   $_v->type;
                $grabdata->event_id     =   $_v->id;
                $grabdata->magnitude    =   $_v->properties->mag;
                $grabdata->event_detail =   $_v->properties->url;
                $grabdata->event_title  =   $_v->properties->title;
                $grabdata->event_place  =   $_v->properties->place;
                $grabdata->properties_type  =    $_v->properties->type;
                $grabdata->properties   =   $_v->properties;
                $grabdata->geo_attr     =   $_v->geometry;
                $grabdata->event_time   =   substr($_v->properties->time, 0, -3);
                $grabdata->save();
            }
        }


    }





