@foreach ($post_titles as $i => $post_title)
    <tr data-row-id="{{ $i }}">
        <td><button class="favourite-btn">Favourite</button></td>
        <td>{{ $post_title }}</td>
        <td><img src="{{ $image_urls[$i] }}" alt="Image"></td>
        <td><a href="{{ $page_urls[$i] }}" target="_blank"><button>URL</button></a></td>
        <td>{{ $descriptions[$i] }}</td>
        <td>
        <p>{{ $replies[$i] }}</p>
    </td>
        <td data-class="location">{{ $locations[$i] }}</td>
        <td>Whatsapp</td>
        <td>{{ $usernames[$i] }}</td>
        <td>{{ $updated_at[$i] }}</td>
        <td>Post Time</td>
        <td data-class="created-date">{{ $created_dates[$i] }}</td>
    </tr>
@endforeach
</tbody>
</table>
</div>
</div>