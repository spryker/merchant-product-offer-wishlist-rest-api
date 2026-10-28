<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantProductOfferWishlistRestApi\Communication\Plugin;

use ArrayObject;
use Generated\Shared\Transfer\WishlistItemRequestTransfer;
use Generated\Shared\Transfer\WishlistItemResponseTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\WishlistsRestApiExtension\Dependency\Plugin\RestWishlistItemsAttributesUpdateStrategyPluginInterface;

/**
 * @method \Spryker\Zed\MerchantProductOfferWishlistRestApi\Communication\MerchantProductOfferWishlistRestApiCommunicationFactory getFactory()
 * @method \Spryker\Zed\MerchantProductOfferWishlistRestApi\Business\MerchantProductOfferWishlistRestApiFacadeInterface getFacade()
 * @method \Spryker\Zed\MerchantProductOfferWishlistRestApi\MerchantProductOfferWishlistRestApiConfig getConfig()
 */
class ProductOfferRestWishlistItemsAttributesUpdateStrategyPlugin extends AbstractPlugin implements RestWishlistItemsAttributesUpdateStrategyPluginInterface
{
    /**
     * {@inheritDoc}
     * - Checks if the wishlist item collection holds a product offer item whose identifier `{sku}_{productOfferReference}` matches `WishlistItemRequestTransfer.uuid`.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\WishlistItemRequestTransfer $wishlistItemRequestTransfer
     * @param \ArrayObject<int, \Generated\Shared\Transfer\WishlistItemTransfer> $wishlistItemTransfers
     *
     * @return bool
     */
    public function isApplicable(WishlistItemRequestTransfer $wishlistItemRequestTransfer, ArrayObject $wishlistItemTransfers): bool
    {
        return (bool)$this->getFactory()
            ->createMerchantProductOfferWishlistRestApiReader()
            ->findWishlistItemInWishlistItemCollectionByRequest(
                $wishlistItemRequestTransfer,
                $wishlistItemTransfers,
            );
    }

    /**
     * {@inheritDoc}
     * - Updates the product offer wishlist item whose identifier `{sku}_{productOfferReference}` matches `WishlistItemRequestTransfer.uuid`.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\WishlistItemRequestTransfer $wishlistItemRequestTransfer
     * @param \ArrayObject<int, \Generated\Shared\Transfer\WishlistItemTransfer> $wishlistItemTransfers
     *
     * @return \Generated\Shared\Transfer\WishlistItemResponseTransfer
     */
    public function update(
        WishlistItemRequestTransfer $wishlistItemRequestTransfer,
        ArrayObject $wishlistItemTransfers
    ): WishlistItemResponseTransfer {
        return $this->getFacade()->updateWishlistItem($wishlistItemRequestTransfer, $wishlistItemTransfers);
    }
}
