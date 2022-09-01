<?php

// pour se placer en environnement dusk local
// php artisan serve --env=dusk.local

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Task;

class IndexTaskTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp() : void {
        parent::setUp();
        $this->seed();
    }

    /**
     * teste le nombre de page pour la pagination
     * les liens next et prev marchent-elles
     * un lien de page marche-t-il?
     *
     * @return void
     */
    public function testPaginateTask()
    {
        $this->browse(function (Browser $browser) {
            // il ne va y avoir que deux pages car un total de 10 et 5 par pages
            $browser->visit('/tasks');
            // les 5 premier tasks !! commence à zéro
            for($i =0 ; $i<5; $i++){
                $browser->assertSee("Task number $i");
            }
            $browser->assertDontSee("Task number 5");
            // click lien next
            $browser->click("ul.pagination > li:nth-child(4) > a"); 

            // on est à la page deux de /tasks
            //browser->assertUrlIs(env('APP_URL').'/tasks?page=2');
            
            for($i =5 ; $i<10; $i++){
                $browser->assertSee("Task number $i");
            }

            // la page 2 est active (item.active)
            $this->assertEquals($browser->text("ul.pagination > li.page-item.active > span"), '2');      
        });
    }

    /**
     * teste le nombre de page pour la pagination
     * les liens next et prev marchent-elles
     * un lien de page marche-t-il?
     *
     * @return void
     */
    public function testCanDeleteTask()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tasks');
            $browser->assertSee("Task number 0");

            // id de tr task_index_+id du task car base à 0 puis seedé
            $browser->assertPresent("#task_index_1 > td:nth-child(4) > ul > li:nth-child(3) > form > button");
            $browser->click("#task_index_1 > td:nth-child(4) > ul > li:nth-child(3) > form > button");
            sleep(2);
            $browser->acceptDialog();
            $browser->assertDontSee("Task number 0");

        });
    }

    // a faire click marqué fait ou pas fait

    /**
     * teste l'affichage des checkbox de statut de page
     * et l'opération pour les marquer comme fait
     *
     * @return void
     */
    public function testCanMarkTaskAsDone()
    {
        // le second bouton de check impaire => prending
        $this->browse(function (Browser $browser) {
            $browser->visit('/tasks');
            $browser->assertSee("Task number 1");
            $browser->assertNotChecked("#task_index_2 > td:nth-child(4) > ul > li:nth-child(2) > form > input[type=checkbox]:nth-child(5)");
            $browser->check("#task_index_2 > td:nth-child(4) > ul > li:nth-child(2) > form > input[type=checkbox]:nth-child(5)");
            $browser->assertSee("Task number 1");
            sleep(2);
            $browser->acceptDialog();

            $browser->refresh();
            $browser->assertChecked("#task_index_2 > td:nth-child(4) > ul > li:nth-child(2) > form > input[type=checkbox]:nth-child(5)");
            $browser->storeConsoleLog('filename.txt');
        });
    }

    /**
     * teste le lien vers la page d'édition et d'affichage
     *
     * @return void
     */
    public function testEditAndShowTaskLink()
    {
        // lien edition task id=3 #task_index_4 > td:nth-child(4) > ul > li:nth-child(1) > a
        $this->browse(function (Browser $browser) {
            $browser->visit('/tasks');
            $browser->assertSee("Task number 4");
            $browser->click("#task_index_4 > td:nth-child(4) > ul > li:nth-child(1) > a");
            $browser->assertRouteIs('tasks.edit', '4');
            $browser->visit('/tasks');
            $browser->click("#task_index_3 > td:nth-child(1) > a");
            $browser->assertRouteIs('tasks.show', '3');
        });
    }

}
