<?php
function sortServersByPopulationAndAlphabet($servers) {
    $populationOrder = array(
        'Full',
        'VeryHigh',
        'High',
        'Medium',
        'Low'
    );

    usort($servers, function($a, $b) use ($populationOrder) {
        $aPopOrder = array_search($a['population'], $populationOrder);
        $bPopOrder = array_search($b['population'], $populationOrder);

        if ($aPopOrder === $bPopOrder) {
            return strcmp($a['name'], $b['name']);
        }

        if ($a['population'] === 'Full' && $b['population'] !== 'Full') {
            return -1;
        } elseif ($a['population'] !== 'Full' && $b['population'] === 'Full') {
            return 1;
        }

        if ($a['population'] === 'VeryHigh' && ($b['population'] !== 'Full' && $b['population'] !== 'VeryHigh')) {
            return -1;
        } elseif (($a['population'] !== 'Full' && $a['population'] !== 'VeryHigh') && $b['population'] === 'VeryHigh') {
            return 1;
        }

        if ($a['population'] === 'High' && ($b['population'] === 'Full' || $b['population'] === 'VeryHigh' || $b['population'] === 'Medium')) {
            return -1;
        } elseif (($a['population'] === 'Full' || $a['population'] === 'VeryHigh' || $a['population'] === 'Medium') && $b['population'] === 'High') {
            return 1;
        }

        return ($aPopOrder < $bPopOrder) ? 1 : -1;
    });

    return $servers;
}