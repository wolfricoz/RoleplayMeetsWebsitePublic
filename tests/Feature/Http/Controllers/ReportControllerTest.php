<?php

namespace Http\Controllers;

use App\Http\Controllers\ReportController;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Tests\TestCase;

class ReportControllerTest extends TestCase
{
  public function testIndex(): void
  {
    $user = User::factory()->create();
    $this->actingAs($user);
    $post = Post::factory()->create();
    $this->get(route('posts.report', $post))->assertStatus(302);
  }

  public function testStore(): void
  {
    $user = User::factory()->create();
    $this->actingAs($user);
    $post = Post::factory()->create();

    $request = new Request([
      'reason' => 'User is posting content that is not theirs',
      'description' => 'This is not their content',
    ]);
    $controller = new ReportController();
    $response = $controller->store($request, $post);

    $this->assertEquals(302, $response->getStatusCode());

  }

  public function testAdminIndex(): void
  {
    // return all reports for admin users
    $user = User::factory()->create();
    $this->actingAs($user);
    $controller = new ReportController();
    $response = $controller->admin();
    $this->assertCount(1, $response->getData()['reports']);


  }

  public function testChangeStatus(): void
  {
    // change the status of a report
    $user = User::factory()->create();
    $this->actingAs($user);
    $report = Report::all()->first();
    $controller = new ReportController();
    $response = $controller->changeStatus($report, 'approved');
    $this->assertEquals('approved', $report->status);
    $this->assertEquals(302, $response->getStatusCode());
    $this->assertNotEquals('pending', $report->status);
  }
}
