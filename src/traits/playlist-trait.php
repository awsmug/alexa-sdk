<?php

namespace Alexa;

/**
 * Class Directive
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
trait Playlist
{
    protected $playlist = array();

    public function playlist_add( $url, $title, $image = false, $token = false ) {
        $item = array(
            'title' => $title,
            'image' => ! $image ? null: $image,
            'token' => ! $token ? md5( $url ): $token,
            'url' => $url
        );

        $this->playlist[] = $item;
    }

    public function playlist_get( $number = 0 ){
        if( array_key_exists( $number, $this->playlist ) ) {
            return $this->playlist[ $number ];
        }

        return false;
    }

    public function playlist_get_by_token( $token ) {
        foreach( $this->playlist AS $item ) {
            if( $token === $item[ 'token'] ) {
                return $item;
            }
        }

        return false;
    }

    public function playlist_get_previous_by_token( $token ) {
        $prev_item = false;

        foreach( $this->playlist AS $item ) {
            if( $token === $item[ 'token'] ) {
                return $prev_item;
            }
            $prev_item = $item;
        }

        return false;
    }

    public function playlist_get_next_by_token( $token ) {
        $found = false;

        foreach( $this->playlist AS $item ) {
            if( $found ) {
                return $item;
            }
            if( $token === $item[ 'token'] ) {
                $found = true;
            }
        }

        return false;
    }

    public function playlist_get_all_items() {
        return $this->playlist;
    }

    public function playlist_count_items() {
        return count( $this->playlist );
    }

    public function playlist_reverse() {
        $this->playlist = array_reverse( $this->playlist );
    }
}
