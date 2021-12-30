<?php
declare(strict_types=1);

namespace Slashplus\FrontendLinks\Block\Adminhtml;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Show
 *
 * Block class for showing the frontend link in Magento 2 administration.
 */
class Show extends \Magento\Backend\Block\Template
{
    /**
     * Block template filename
     *
     * @var string
     */
    protected $_template = 'Slashplus_FrontendLinks::show.phtml';

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private \Magento\Catalog\Api\ProductRepositoryInterface $productRepository;

    /**
     * @var \Magento\Framework\Registry
     */
    private \Magento\Framework\Registry $registry;

    /**
     * @var \Magento\Framework\App\State
     */
    private \Magento\Framework\App\State $state;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private \Magento\Store\Model\StoreManagerInterface $storeManager;

    /**
     * Show constructor.
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\State $state
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context         $context,
        \Magento\Framework\Registry                     $registry,
        \Magento\Framework\App\State                    $state,
        \Magento\Store\Model\StoreManagerInterface      $storeManager,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        array                                           $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->state = $state;
        $this->storeManager = $storeManager;
        $this->productRepository = $productRepository;
    }

    /**
     * Get the product frontend url by using the currently selected website store id
     *
     * @return string
     */
    public function getProductFrontendUrl(): string
    {
        $storeId = $this->getSelectedWebsiteId();
        if ($storeId !== null && ($product = $this->getProduct($storeId))) {
            return $product->getProductUrl();
        }

        return '';
    }

    /**
     * Get the currently selected website id
     *
     * @return int|null
     */
    public function getSelectedWebsiteId(): ?int
    {
        $storeId = null;
        try {
            if ($this->state->getAreaCode() === \Magento\Framework\App\Area::AREA_ADMINHTML) {
                $request = $this->_request;
                $storeId = $request->getParam('store');
            }
        } catch (LocalizedException $e) {
            return null;
        }

        try {
            $websiteId = $this->storeManager->getStore($storeId)->getWebsiteId();
            return $websiteId === null ? null : (int)$websiteId;
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Get store specific product instance
     *
     * @param int $storeId
     * @return \Magento\Catalog\Api\Data\ProductInterface | null
     */
    public function getProduct(int $storeId): ?\Magento\Catalog\Api\Data\ProductInterface
    {
        $currentProduct = $this->registry->registry('current_product');
        try {
            return $this->productRepository->getById($currentProduct->getId(), false, $storeId);
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Get the store url
     *
     * @param int $storeId
     * @return string
     */
    public function getStoreUrl(int $storeId): string
    {
        try {
            $store = $this->_storeManager->getStore($storeId);
            return (string)$store->getBaseUrl();
        } catch (NoSuchEntityException|\InvalidArgumentException $e) {
            return '';
        }
    }
}
