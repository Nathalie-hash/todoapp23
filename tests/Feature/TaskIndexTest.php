<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskIndexTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void {
        parent::setUp();
        config(['app.url' => 'http://127.0.0.1:8000']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanEditStatus()
    {
        $task = Task::create([
            "title" => "new task", "status" => "done"
        ]);
        
        $response = $this->putJson("/tasks/$task->id", [
            "title" => "new task", "status" => "pending"
        ]);

        $task->refresh();
        $this->assertEquals("pending", $task->status, "status edited");
    }

        /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanDeleteTask()
    {
        $task = Task::create([
            "title" => "new task", "status" => "done"
        ]);

        $response = $this->deleteJson("/tasks/$task->id");
        $response->assertRedirect("/tasks");

        $this->assertEquals(null, Task::find($task->id), "Task suppressed");
    }


}
