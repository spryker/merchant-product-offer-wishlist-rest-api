<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantProductOfferWishlistRestApi\Business;

use ArrayObject;
use Generated\Shared\Transfer\WishlistItemRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Spryker\Zed\MerchantProductOfferWishlistRestApi\Business\MerchantProductOfferWishlistRestApiBusinessFactory getFactory()
 */
class MerchantProductOfferWishlistRestApiFacade extends AbstractFacade implements MerchantProductOfferWishlistRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\WishlistItemRequestTransfer $wishlistItemRequestTransfer
     * @param \ArrayObject<int, \Generated\Shared\Transfer\WishlistItemTransfer> $wishlistItemTransfers
     *
     * @return void
     */
    public function deleteWishlistItem(
        WishlistItemRequestTransfer $wishlistItemRequestTransfer,
        ArrayObject $wishlistItemTransfers
    ): void {
        $this->getFactory()->createMerchantProductOfferWishlistRestApiDeleter()->deleteWishlistItem(
            $wishlistItemRequestTransfer,
            $wishlistItemTransfers,
        );
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\WishlistItemRequestTransfer $wishlistItemRequestTransfer
     * @param \ArrayObject<int, \Generated\Shared\Transfer\WishlistItemTransfer> $wishlistItemTransfers
     *
     * @return void
     */
    public function deleteWishlistItemWithoutProductOffer(
        WishlistItemRequestTransfer $wishlistItemRequestTransfer,
        ArrayObject $wishlistItemTransfers
    ): void {
        $this->getFactory()->createMerchantProductOfferWishlistRestApiDeleter()->deleteWishlistItemWithoutProductOffer(
            $wishlistItemRequestTransfer,
            $wishlistItemTransfers,
        );
    }
}
