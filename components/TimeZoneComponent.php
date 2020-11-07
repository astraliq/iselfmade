<?php


namespace app\components;


class TimeZoneComponent {
    /**
     * * Возвращает массив российских часовых поясов, где:
     * ключ - смещение от UTC
     * значение - массив с названиями поясов (англ)
     * @param string $type
     * @return array
     * @throws \Exception
     */
    public function getRuTimezones($type='full') {
        $ruZones = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, 'RU');
        $timezonesArr = [];
        $dt = new \DateTime('now', new \DateTimeZone('UTC'));
        switch ($type) {
            case 'full':
                foreach($ruZones as $tz) {
                    $timezonesArr[] = [
                        'timeZone' => $tz,
                        'localTime' => $dt->setTimeZone(new \DateTimeZone($tz))->format('H:i'),
                        'offset' => $dt->setTimeZone(new \DateTimeZone($tz))->getOffset() / 3600,
                    ];
                }
                break;
            case 'short_gmt':
                foreach($ruZones as $tz) {
                    $offset = $dt->setTimeZone(new \DateTimeZone($tz))->getOffset() / 3600;
                    $offset = $offset > 0 ? '+' . $offset : $offset;
                    $timezonesArr[] = $tz . ' (GMT' . $offset .')';
                }
                break;
            case 'short':
                foreach($ruZones as $tz) {
                    $timezonesArr[] = $tz;
                }
                break;
        }
        return $timezonesArr;
    }

    public function getAllTimezones($type='full') {
        $zones = \DateTimeZone::listIdentifiers();
        $timezonesArr = [];
        $dt = new \DateTime('now', new \DateTimeZone('UTC'));
        switch ($type) {
            case 'full':
                foreach($zones as $tz) {
                    $timezonesArr[] = [
                        'timeZone' => $tz,
                        'localTime' => $dt->setTimeZone(new \DateTimeZone($tz))->format('H:i'),
                        'offset' => $dt->setTimeZone(new \DateTimeZone($tz))->getOffset() / 3600,
                    ];
                }
                break;
            case 'short_gmt':
                foreach($zones as $tz) {
                    $offset = $dt->setTimeZone(new \DateTimeZone($tz))->getOffset() / 3600;
                    $offset = $offset > 0 ? '+' . $offset : $offset;
                    $timezonesArr[] = $tz . ' (GMT' . $offset .')';
                }
                break;
            case 'short':
                foreach($zones as $tz) {
                    $timezonesArr[] = $tz;
                }
                break;
        }
        return $timezonesArr;
    }

    public function getOffsetTimezone($tz) {
        $dt = new \DateTime('now', new \DateTimeZone('UTC'));
        return $dt->setTimeZone(new \DateTimeZone($tz))->getOffset() / 3600;
    }
}