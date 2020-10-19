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
        $timezonesArr = [];
        $dt = new \DateTime('now', new \DateTimeZone('UTC'));
        foreach(\DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, 'RU') as $tz) {
            $timezonesArr[] = [
                'timeZone' => $tz,
                'localTime' => $dt->setTimeZone(new \DateTimeZone($tz))->format('H:i'),
                'offset' => $dt->setTimeZone(new \DateTimeZone($tz))->getOffset() / 3600,
            ];
//            echo $tz, ': ', $dt->format('Y.m.d H:i:s'), "\n";
        }
        return $timezonesArr;
    }

    public function getAllTimezones() {
        $timezonesArr = [];
        $dt = new \DateTime('now', new \DateTimeZone('UTC'));
        foreach(\DateTimeZone::listIdentifiers() as $tz) {
            $timezonesArr[] = [
                'timeZone' => $tz,
                'localTime' => $dt->setTimeZone(new \DateTimeZone($tz))->format('H:i'),
                'offset' => $dt->setTimeZone(new \DateTimeZone($tz))->getOffset() / 3600,
            ];
//            echo $tz, ': ', $dt->format('Y.m.d H:i:s'), "\n";
        }
        return $timezonesArr;
    }
}