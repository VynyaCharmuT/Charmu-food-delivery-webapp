import { createContext, useState, useEffect } from 'react';

export const CartContext = createContext();

    function CartProvider({ children }){

    const [cart, setCart] = useState(() => {

    const savedCart = localStorage.getItem('cart');

    return savedCart
        ? JSON.parse(savedCart)
        : [];

});

useEffect(() => {

    localStorage.setItem(
        'cart',
        JSON.stringify(cart)
    );

}, [cart]);

    /* ADD TO CART */

    const addToCart = (product) => {

        const existing = cart.find(

            item => item.id === product.id

        );

        if(existing){

            const updatedCart = cart.map(item =>

                item.id === product.id

                ? {

                    ...item,

                    quantity: item.quantity + 1

                }

                : item

            );

            setCart(updatedCart);

        }

        else{

            setCart([

                ...cart,

                {

                    ...product,

                    quantity:1

                }

            ]);

        }

    };

    /* INCREASE QUANTITY */

    const increaseQty = (id) => {

        const updatedCart = cart.map(item =>

            item.id === id

            ? {

                ...item,

                quantity:item.quantity + 1

            }

            : item

        );

        setCart(updatedCart);

    };

    /* DECREASE QUANTITY */

    const decreaseQty = (id) => {

        const updatedCart = cart.map(item =>

            item.id === id

            ? {

                ...item,

                quantity:item.quantity - 1

            }

            : item

        ).filter(item => item.quantity > 0);

        setCart(updatedCart);

    };

    /* GRAND TOTAL */

    const grandTotal = cart.reduce(

    (total, item) =>

        total +

        (

            Number(item.price)

            *

            Number(item.quantity)

        ),

    0

);

    return(

        <CartContext.Provider
        value={{

            cart,
            setCart,
            addToCart,
            increaseQty,
            decreaseQty,
            grandTotal

        }}>

            {children}

        </CartContext.Provider>

    )

}

export default CartProvider;