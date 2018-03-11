<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotesTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCheckAvailableToWithdraw()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Cash Machine')
                    ->type('notes', '120,00')
                    ->press('Withdraw')
                    ->waitForText('$10.00')
                    ->assertSee('$10.00')
                    ->assertSee('$20.00')
                    ->assertSee('$50.00');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCantWithdrawCantDivideNotes()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Cash Machine')
                ->type('notes', '125,00')
                ->press('Withdraw')
                ->waitForText('throw NoteUnavailableException')
                ->assertSee('throw NoteUnavailableException');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCantWithdrawUnderTenDollars()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Cash Machine')
                ->type('notes', '-120,00')
                ->press('Withdraw')
                ->waitForText('throw InvalidArgumentException')
                ->assertSee('throw InvalidArgumentException');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCantWithdrawEmptyNotes()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Cash Machine')
                ->type('notes', '')
                ->press('Withdraw')
                ->waitForText('[Empty Set]')
                ->assertSee('[Empty Set]');
        });
    }
}
