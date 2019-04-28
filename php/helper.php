<?php
    class Helper{

        public function check( $req ){
            $res = [];

            $regexp = [
                'name'  => '/^[a-zA-Zа-яёА-ЯЁ]{2,}$/u',
                'phone' => '/\+7\([0-9]{3}\)[0-9]{2}\-[0-9]{2}\-[0-9]{3}$/',
            ];

            $res['success'] = preg_match( $regexp[ $req['name'] ], urldecode( $req['value'] ) );

            return $res;
        }

        public function send( $req ){
            $res = [];

            $will_we_send = true;

            foreach ( $req as $key => $value ){

                if ( $key != 'command' ){

                    $tmp = [ 'name' => $key, 'value' => $value ];

                    if ( !$this->check( $tmp )['success'] ){
                        $will_we_send = false;
                    }
                }
            }

            if ( $will_we_send ){
                //отправка мыла
                $res['success'] = 1;
            } else {
                //всё плохо
                $res['success'] = 0;
            }

            return $res;
        }
    }
?>