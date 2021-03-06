<?php
namespace verbb\wishlist\variables;

use verbb\wishlist\Wishlist;
use verbb\wishlist\elements\db\ItemQuery;
use verbb\wishlist\elements\db\ListQuery;
use verbb\wishlist\elements\Item;
use verbb\wishlist\elements\ListElement;

use Craft;
use craft\helpers\UrlHelper;
use craft\web\View;

use yii\base\Behavior;

class WishlistVariable
{
    // Public Methods
    // =========================================================================

    public function getPluginName()
    {
        return Wishlist::$plugin->getPluginName();
    }

    public function lists($forUser = true): ListQuery
    {
        if ($forUser) {
            return Wishlist::$plugin->getLists()->getListQueryForOwner();
        } else {
            return ListElement::find();
        }
    }

    public function items(): ItemQuery
    {
        return Item::find();
    }

    public function item($elementId, $listId = null)
    {
        $item = null;

        if (!$listId) {
            $list = Wishlist::$plugin->getLists()->getList(null, true);

            $item = Item::find()->elementId($elementId)->listId($list->id)->one();
        }

        if (!$item) {
            $item = WishList::$plugin->getItems()->createItem($elementId, $listId);
        }

        return $item;
    }

}
