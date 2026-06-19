import { useEffect, useState } from 'react';

import Navbar from '../components/Navbar';

import ProductCard from '../components/ProductCard';

function Home(){

    const [products, setProducts] = useState([]);

    const [search, setSearch] = useState('');

const [category, setCategory] = useState('All');

    /* FETCH PRODUCTS */

    useEffect(() => {

        fetch('http://localhost/food-app/api/products.php')

        .then(res => res.json())

        .then(data => {

            setProducts(data);

        });

    }, []);

    const filteredProducts = products.filter(product => {

    const matchesSearch = product.name

    .toLowerCase()

    .includes(search.toLowerCase());

    const matchesCategory =

    category === 'All'

    ||

    product.category === category;

    return matchesSearch && matchesCategory;

});

    return(

        <div>

            <Navbar />

            <div className="container mt-5">

                <div className="hero text-center p-5 mb-5">

<h1 className="display-3 fw-bold">

🍔 FoodieHub

</h1>

<p className="lead text-light">

Premium Food Delivery Experience

</p>

<button className="btn btn-warning btn-lg mt-3">

Order Now

</button>

</div>

                <div className="row mb-4">

    <div className="col-md-6">

        <input

        type="text"

        className="form-control premium-search"

        placeholder="Search foods..."

        value={search}

        onChange={(e) =>

        setSearch(e.target.value)

        }

        />

    </div>

    <div className="col-md-4">

        <select

        className="form-select premium-search"

        value={category}

        onChange={(e) =>

        setCategory(e.target.value)

        }

        >

            <option value="All">

                All Categories

            </option>

            <option value="Cakes">

                Cakes

            </option>

            <option value="Combos">

                Combos

            </option>

            <option value="Pizza">

                Pizza

            </option>

            <option value="Ice Cream">

                Ice Cream

            </option>

            <option value="Rice Item">

                Rice Item

            </option>

        </select>

    </div>

</div>

                <div className="row">

    {filteredProducts.map(product => (

        <ProductCard
        key={product.id}
        product={product}
        />

    ))}

</div>

            </div>

        </div>

    )

}

export default Home;