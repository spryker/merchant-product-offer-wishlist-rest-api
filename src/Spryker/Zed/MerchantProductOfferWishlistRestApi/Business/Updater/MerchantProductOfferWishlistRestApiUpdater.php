<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantProductOfferWishlistRestApi\Business\Updater;

use ArrayObject;
use Generated\Shared\Transfer\WishlistItemRequestTransfer;
use Generated\Shared\Transfer\WishlistItemResponseTransfer;
use Generated\Shared\Transfer\WishlistItemTransfer;
use Spryker\Zed\MerchantProductOfferWishlistRestApi\Dependency\Facade\MerchantProductOfferWishlistRestApiToWishlistFacadeInterface;

class MerchantProductOfferWishlistRestApiUpdater implements MerchantProductOfferWishlistRestApiUpdaterInterface
{
    protected const string WISHLIST_ITEM_IDENTIFIER_PATTERN = '%s_%s';

    public function __construct(protected MerchantProductOfferWishlistRestApiToWishlistFacadeInterface $wishlistFacade)
    {
    }

    /**
     * @param \ArrayObject<int, \Generated\Shared\Transfer\WishlistItemTransfer> $wishlistItemTransfers
     */
    public function updateWishlistItem(
        WishlistItemRequestTransfer $wishlistItemRequestTransfer,
        ArrayObject $wishlistItemTransfers
    ): WishlistItemResponseTransfer {
        $wishlistItemTransfer = $this->findWishlistItemByIdentifier($wishlistItemRequestTransfer, $wishlistItemTransfers);

        if ($wishlistItemTransfer === null) {
            return (new WishlistItemResponseTransfer())->setIsSuccess(false);
        }

        $sku = $wishlistItemRequestTransfer->getSku() ?? $wishlistItemTransfer->getSku();

        $wishlistItemTransfer = $wishlistItemTransfer
            ->fromArray($wishlistItemRequestTransfer->toArray(), true)
            ->setSku($sku);

        return $this->wishlistFacade->updateWishlistItem($wishlistItemTransfer);
    }

    /**
     * @param \ArrayObject<int, \Generated\Shared\Transfer\WishlistItemTransfer> $wishlistItemTransfers
     */
    protected function findWishlistItemByIdentifier(
        WishlistItemRequestTransfer $wishlistItemRequestTransfer,
        ArrayObject $wishlistItemTransfers
    ): ?WishlistItemTransfer {
        foreach ($wishlistItemTransfers as $wishlistItemTransfer) {
            if (!$wishlistItemTransfer->getProductOfferReference()) {
                continue;
            }

            $wishlistItemIdentifier = sprintf(
                static::WISHLIST_ITEM_IDENTIFIER_PATTERN,
                $wishlistItemTransfer->getSku(),
                $wishlistItemTransfer->getProductOfferReference(),
            );

            if ($wishlistItemRequestTransfer->getUuid() === $wishlistItemIdentifier) {
                return $wishlistItemTransfer;
            }
        }

        return null;
    }
}
