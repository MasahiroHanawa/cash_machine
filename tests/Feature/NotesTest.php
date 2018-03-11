<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotesTest extends TestCase
{
    /**
     * A withdraw normal test case.
     *
     * @return void
     */
    public function testCheckAvailableToWithdraw()
    {
        $this->post('/api/notes/1', ['notes' => '120.00'])
            ->assertJson([
                'notes' => [10, 10, 10, 20, 20, 50]
            ]);
    }

    /**
     * can't withdraw when can't divide price apply.
     *
     * @return void
     */
    public function testCantWithdrawCantDivideNotes()
    {
        $this->json('POST', '/api/notes/1', ['notes' => '125.00'])
            ->assertJson([
                'errors' => 'throw NoteUnavailableException',
                'status' => 405
            ]);
    }

    /**
     * can't withdraw when can't divide price apply.
     *
     * @return void
     */
    public function testCantWithdrawUnderTenDollars()
    {
        $this->json('POST', '/api/notes/1', ['notes' => '-120.00'])
            ->assertJson([
                'errors' => 'throw InvalidArgumentException',
                'status' => 405
            ]);
    }

    /**
     * can't withdraw when can't divide price apply.
     *
     * @return void
     */
    public function testCantWithdrawEmptyNotes()
    {
        $this->json('POST', '/api/notes/1', ['notes' => ''])
            ->assertJson([
                'errors' => '[Empty Set]',
                'status' => 405
            ]);
    }

}
