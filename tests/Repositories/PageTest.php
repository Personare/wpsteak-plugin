<?php declare(strict_types = 1);

/**
 * Page test.
 *
 * @package App\Test
 */

namespace App\Test\Repositories;

use App\Entities\Page as Entity;
use App\Repositories\Page as Repository;

/**
 * Page test class.
 */
final class PageTest extends \PHPUnit\Framework\TestCase {

	private \WP_Post $post;

	/** @var \App\Repositories\Page&\PHPUnit\Framework\MockObject\MockObject $repository */
	private Repository $repository;

	public function setUp(): void {
		$this->post = $this->getMockBuilder( 'WP_Post' )->getMock();
		$this->repository = $this->getMockBuilder( Repository::class )
			->disableOriginalConstructor()
			->setMethods( ['get_post'] )
			->getMock();
	}

	public function test_find_one_by_post_fail(): void {
		$this->repository->method( 'get_post' )
			->will( $this->returnValue( null ) );

		$entity = $this->repository->find_one_by_post( $this->post );

		$this->assertNull( $entity );
	}

	public function test_find_one_by_post_success(): void {
		$this->repository->method( 'get_post' )
			->will( $this->returnValue( $this->post ) );

		$entity = $this->repository->find_one_by_post( $this->post );

		$this->assertInstanceOf( Entity::class, $entity );
	}

}
