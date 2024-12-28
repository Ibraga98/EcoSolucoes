document.addEventListener('DOMContentLoaded', async () => {
    try {
        const response = await fetch('php/products.php');
        const products = await response.json();

        const productList = document.getElementById('product-list');

        products.forEach(({id, name, description, price}) => {
            const productCard = document.createElement('div');
            productCard.classList.add('product-card');
            productCard.innerHTML = `
                <h3>${name}</h3>
                <p>${description}</p>
                <p>Preço: €${price}</p>
                <button data-id="${id}" class="add-to-cart">Adicionar ao Carrinho</button>
            `;
            productList.appendChild(productCard);
        });

        productList.addEventListener('click', async (e) => {
            if (e.target.classList.contains('add-to-cart')) {
                const productId = e.target.getAttribute('data-id');
                try {
                    await fetch('php/cart.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({product_id: productId})
                    });
                    alert('Produto adicionado ao carrinho!');
                } catch (err) {
                    console.error('Erro ao adicionar o produto ao carrinho:', err);
                }
            }
        });
    } catch (err) {
        console.error('Erro ao carregar os produtos:', err);
    }
});
