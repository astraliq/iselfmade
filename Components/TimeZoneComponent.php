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
    public function getRuTimezones($type='full') {
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
        if ($type == 'short_gmt') {
            $shortArr = [];
            foreach ($timezonesArr as $zone) {
                $offset = $zone['offset'] > 0 ? '+' . $zone['offset'] : $zone['offset'];
//                array_merge($shortArr, [$zone['timeZone'] => ' (GMT' . $offset .')']);
                $newKey = $zone['timeZone'];
                $shortArr[] = $zone['timeZone'] . ' (GMT' . $offset .')';
            }
            return $shortArr;
        }
        if ($type == 'short') {
            $shortArr = [];
            foreach ($timezonesArr as $zone) {
                $offset = $zone['offset'] > 0 ? '+' . $zone['offset'] : $zone['offset'];
//                array_merge($shortArr, [$zone['timeZone'] => ' (GMT' . $offset .')']);
                $newKey = $zone['timeZone'];
                $shortArr[] = $zone['timeZone'];
            }
            return $shortArr;
        }
        return $timezonesArr;
    }

    public function getAllTimezones($type='full') {
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
        if ($type == 'short') {
            $shortArr = [];
            foreach ($timezonesArr as $zone) {
                $offset = $zone['offset'] > 0 ? '+' . $zone['offset'] : $zone['offset'];
                $shortArr[] = $zone['timeZone'] . ' (GMT' . $offset .')';
            }
            return $shortArr;
        }
        return $timezonesArr;
    }
}