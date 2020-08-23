<?php
    namespace map;

    use EQ\Action;
    use EQ\EarthQuart;

    class genmap extends Action {


        public function get() {
            $date = filter_input(INPUT_GET, "date");
            $date_timestampe = strtotime("$date 00:00");
            $date_backroll = strtotime("-1 days", $date_timestampe);

            $data_result = EarthQuart::select()
                ->fields('*')
                ->where("event_time", $date_backroll, '>=')
                ->where("event_time", $date_timestampe, '<=')
                ->getArray();

            foreach ($data_result as $key=>$_v) {
                $location[$key]     = $_v->geo_attr;
                $eventtime[$key]    =   $_v->event_time;
                $eventplace[$key]   =   $_v->event_place;
                $eventmag[$key]     =   $_v->magnitude;
            }
            $this->view->assign("dataresult", $data_result);

        }
    }