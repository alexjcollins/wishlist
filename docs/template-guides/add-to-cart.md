# Add to Cart

A great feature for a Commerce site is to allow your customers to create wishlist's of product they want to purchase, saved to their account for later purchase. To provide an even more seamless user experience would be to allow customers to add these wishlist items to their cart to purchase.

That's exactly what you can do with the following code:

```twig
{% set list = craft.wishlist.lists().default(true).one() %}

<form method="POST">
    <input type="hidden" name="action" value="wishlist/lists/add-to-cart">
    {{ csrfInput() }}
    {{ redirectInput('/shop/cart') }}

    <input type="text" name="listId" value="{{ list.id }}">

    <input type="submit" value="Add to Cart">
</form>
```

This will look through any Purchasable object in the list, and add it to your cart.

For even greater flexibility, you can include a few other useful bits of information, such as quantity or line item options. You might even have these saved as custom fields on the Item object.

```twig
{% set list = craft.wishlist.lists().default(true).one() %}

<form method="POST">
    <input type="hidden" name="action" value="wishlist/lists/add-to-cart">
    {{ csrfInput() }}
    {{ redirectInput('/shop/cart') }}

    <input type="text" name="listId" value="{{ list.id }}">

    {% for item in list.items %}
        <input type="text" name="purchasables[{{ item.id }}][qty]" value="10">
        <input type="text" name="purchasables[{{ item.id }}][options][test]" value="Some Value">
    {% endfor %}

    <input type="submit" value="Add to Cart">
</form>
```
