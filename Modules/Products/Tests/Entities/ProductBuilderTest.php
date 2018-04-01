<?php

namespace Modules\Products\Entities;

use Tests\TestCase;
use Modules\Products\Http\Requests\ProductsRequest;

class ProductBuilderTest extends TestCase
{
    protected $builder;

    protected $loggedUserId;

    protected $request;

    protected $product;

    public function setUp()
    {
        $this->builder = new ProductBuilder();
    }

    /**
     * @test
     */
    public function mustBuildAProductUsingRequest()
    {
        $this->givenARequest();
        $this->whenTryToBuildProduct();
        $this->thenProductMustBeBuiltWithSuccess();
    }

    /**
     * @test
     */
    public function mustBuildAProductWithTheSameDataFromRequestData()
    {
        $this->givenARequest();
        $this->whenTryToBuildProduct();
        $this->thenProductDataMustBeTheSameAsRequestData();
    }

    /**
     * @test
     */
    public function mustBuildAProductWithLoggedUserId()
    {
        $this->givenALoggedUser();
        $this->whenTryToBuildProduct();
        $this->thenProductUserIdMustBeTheSameAsAuthedUser();
    }

    public function givenALoggedUser()
    {
        $this->createRequestMock();
        $this->loggedUserId = rand(0, 100);
    }

    public function givenARequest()
    {
        $this->createRequestMock();
    }

    public function createRequestMock()
    {
        $this->request = $this->getMockBuilder(ProductsRequest::class)
            ->getMock();

        $this->request->expects($this->any())
            ->method('all')
            ->willReturn([
                'name' => 'sumo de laranja'
            ]);
    }

    public function whenTryToBuildProduct()
    {
        $this->product = $this->builder->build(
            $this->loggedUserId,
            $this->request
        );
    }

    public function thenProductMustBeBuiltWithSuccess()
    {
        $this->assertInstanceOf(
            \Modules\Products\Entities\Products::class,
            $this->product
        );
    }

    public function thenProductDataMustBeTheSameAsRequestData()
    {
        $requestData = $this->request->all();
        $productData = $this->parseProductToArray($this->product);

        $this->assertEquals(
            $requestData,
            $productData
        );
    }

    public function parseProductToArray($product)
    {
        return [
            'name' => $product->name
        ];
    }

    public function thenProductUserIdMustBeTheSameAsAuthedUser()
    {
        $this->assertEquals(
            $this->loggedUserId,
            $this->product->user_id
        );
    }
}
