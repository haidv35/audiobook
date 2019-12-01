<table>
    <thead>
    <tr>
        <th>category_id</th>
        <th>title</th>
        <th>short_description</th>
        <th>description</th>
        <th>image</th>
        <th>demo_link</th>
        <th>regular_price</th>
        <th>discount_price</th>
        <th>product_link</th>
        <th>new_product</th>
        <th>hot_product</th>
        <th>qty_purchased</th>
        <th>created_at</th>
        <th>updated_at</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            @php
                $product_links = ""
            @endphp
            @foreach ($product->product_links as $product_link)
                @php
                    $product_links .= $product_link->content . nl2br("\n")
                @endphp
            @endforeach
            <tr>
                <td>{{ $product->category_id }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->short_description }}</td>
                <td>{{ $product->description['content'] }}</td>
                <td>{{ $product->image }}</td>
                <td>{{ $product->demo_link }}</td>
                <td>{{ $product->regular_price }}</td>
                <td>{{ $product->discount_price }}</td>
                <td>{{ $product_links }}</td>
                <td>{{ $product->new_product }}</td>
                <td>{{ $product->hot_product }}</td>
                <td>{{ $product->qty_purchased }}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
