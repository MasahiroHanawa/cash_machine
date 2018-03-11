<?php
namespace App\Services;

class NotesService
{
    // it's better to add as notes master table
    public static $AVAILABLE_NOTE_LIST = [
        10.00,
        20.00,
        50.00,
        100.00
    ];

    public function calculateNotes ($notes)
    {
        $result = [];
        $notes = str_replace(',', '.', $notes);

        if (empty($notes))
        {
            abort('405', '[Empty Set]');
        }
        else if (empty($notes) || !is_numeric($notes) || $notes < 10)
        {
            abort('405', 'throw InvalidArgumentException');
        }
        else if ($notes % 10 != 0)
        {
            abort('405', 'throw NoteUnavailableException');
        }
        else if (is_numeric($notes) && $notes % 10 == 0 && !empty($notes) )
        {
            $result = $this->addLowestNotes($notes);
        }

        return $result;
    }
    
    protected function addLowestNotes ($notes)
    {
        $i = 0;
        $fails = 0;
        $result = [];
        while ($notes != 0)
        {
            if ($notes >= self::$AVAILABLE_NOTE_LIST[$i])
            {
                $result['notes'][] = self::$AVAILABLE_NOTE_LIST[$i];
                $notes = $notes - self::$AVAILABLE_NOTE_LIST[$i];
                $fails = 0;
            } 
            else 
            {
                $fails++;
            }

            if ($fails > 4)
            {
                abort('405', 'throw NoteUnavailableException');
                break;
            }

            if ($i == 3 && $notes < self::$AVAILABLE_NOTE_LIST[$i])
            {
                $i = 0;
            }
            else if ($i < 3)
            {
                $i++;
            }
        }
        usort($result['notes'], function($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        });
        return $result;
    }
}