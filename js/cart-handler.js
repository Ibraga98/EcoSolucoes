
function redirectToCart(productId) {
    if (!productId) {
        console.error("Error: productId is required");
        return;
    }
    console.log("Redirecting to cart with productId:", productId);
    window.location.href = `cart.html?productId=${encodeURIComponent(productId)}`;
}
