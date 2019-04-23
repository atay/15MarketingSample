<?php

namespace App\Commands;

class Enter extends Base {

    private function stdResponse($data) {
        $time = date("Y-mdTH:i:s");
        $sessionCode = $this->getInputFile()->getValueByPath('@attributes.session');
        $staticPart = [
            '@attributes' => [
                'session' => $sessionCode,
                'time'    => $time,
            ],
            'enter' => [
                'id',
            ],
        ];
        return $this->getResponse()->addArray($this->arrayMergeDeep([$staticPart, $data]));
    }

    private function stdError($code, $msg) {
        return $this->stdResponse([
            'enter' => [
                'result' => 'fail',
                'error' => [
                    '@attributes' => [
                        'code' => $code,
                    ],
                    'msg' => $msg,
                ],
            ]
        ]);
    }


    public function process()
    {
        $launchKey = $this->getInputFile()->getValueByPath('enter.@attributes.id');
        $sessionData = $this->getRepository()->getSessionByLaunchKey($launchKey, ['id', 'user_id']);

        if (!$sessionData) {
            return $this->processNoSessionData();
        }

        $code = $this->getInputFile()->getValueByPath('enter.game.@attributes.name');
        $gameCode = "PSN_" . $code;
        if (!$this->getRepository()->slotExistForGameCode($gameCode)) {
            return $this->stdError('GAME_NOT_ALLOWED', 'The game is not available for the player.');
        }

        $id = $this->getInputFile()->getValueByPath('enter.@attributes.id');
        $account = $this->getRepository()->getAccountById($id);

        if ($account['exclusion'] == 1 && !$account['activity_status']) {
            return $this->stdError('USER_BLOCKED', 'User is blocked.');
        }

        $this->getRepository()->updateSession($id, ['gamecode' => $gameCode]);
        return $this->stdResponse([
            'enter' => [
                '@attributes' => [
                    'result' => 'ok',
                ],
                'user' => [
                    '@attributes' => [
                        'mode' => 'normal',
                        'type' => 'real',
                        'wlid' => $sessionData['user_id'],
                    ],
                ],
            ],
        ]);
    }


    private function processNoSessionData()
    {
        $key = $this->getInputFile()->getValueByPath('enter.@attributes.key');
        if ($this->getRepository()->getSessionByLaunchKey($key)) {
            return $this->stdError('KEY_EXPIRED', 'An authentication key has expired or cannot be used any more.');
         }
         return $this->stdError('INVALID_KEY', 'An invalid authentication key is transmitted to WL.');
    }
}