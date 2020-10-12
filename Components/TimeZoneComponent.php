<?php


namespace app\Components;


class TimeZoneComponent {
    /**
     * Возвращает массив российских часовых поясов, где:
     * ключ - смещение от UTC
     * значение - массив с названиями поясов (англ)
     *
     * @return array
     */
    public function getRuTimezones() {
        $arr = [];
        foreach (\DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, 'RU') as $string) {
            $tz = Carbon::now($string)->getTimezone();
            $arr[$tz->toOffsetName()][] = $tz->toRegionName();
        }
        ksort($arr);
        return $arr;
    }

    public function getAllTimezones() {
        $timezonesArr = [];
        $dt = new \DateTime('now', new \DateTimeZone('UTC'));
        foreach(\DateTimeZone::listIdentifiers() as $tz) {
            $timezoneArr[] = [
                $tz,
                $dt->setTimeZone(new \DateTimeZone($tz))->format('H:i'),
            ];
//            echo $tz, ': ', $dt->format('Ymd H:i:s'), "\n";
        }
        return $timezonesArr;
    }
}