<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactInquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\SiteImage;
use App\Models\SuccessStory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    private const SESSION_KEY = 'admin_panel_authenticated';

    public function loginForm(Request $request)
    {
        if ($request->session()->get(self::SESSION_KEY)) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login', [
            'title' => 'Admin Login',
        ]);
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'admin_key' => ['required', 'string'],
        ]);

        $expectedKey = (string) env('ADMIN_PANEL_KEY', 'luxe-curtain-admin');

        if (! hash_equals($expectedKey, $validated['admin_key'])) {
            return back()->withErrors([
                'admin_key' => 'Invalid admin key.',
            ])->onlyInput('admin_key');
        }

        $request->session()->put(self::SESSION_KEY, true);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(self::SESSION_KEY);
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request)
    {
        if ($redirect = $this->guard($request)) {
            return $redirect;
        }

        $resources = $this->resources();

        return view('admin.dashboard', [
            'title' => 'Admin Dashboard',
            'resources' => $resources,
            'stats' => [
                'products' => Product::count(),
                'orders' => Order::count(),
                'consultations' => ContactInquiry::count(),
                'posts' => BlogPost::count(),
                'stories' => SuccessStory::count(),
                'images' => SiteImage::count(),
            ],
            'recentOrders' => Order::query()->latest()->limit(5)->get(),
            'recentConsultations' => ContactInquiry::query()->latest()->limit(5)->get(),
        ]);
    }

    public function index(Request $request, string $section)
    {
        if ($redirect = $this->guard($request)) {
            return $redirect;
        }

        $config = $this->resolveSection($section);
        $items = $config['model']::query()->latest()->get();

        return view('admin.resource-index', [
            'title' => $config['title'],
            'section' => $section,
            'config' => $config,
            'items' => $items,
        ]);
    }

    public function create(Request $request, string $section)
    {
        if ($redirect = $this->guard($request)) {
            return $redirect;
        }

        $config = $this->resolveSection($section);

        return view('admin.resource-form', [
            'title' => 'Create ' . $config['title'],
            'section' => $section,
            'config' => $config,
            'item' => null,
            'method' => 'POST',
            'action' => route('admin.store', $section),
        ]);
    }

    public function store(Request $request, string $section): RedirectResponse
    {
        if ($redirect = $this->guard($request)) {
            return $redirect;
        }

        $config = $this->resolveSection($section);
        $data = $this->validatedData($request, $config);

        $model = $config['model'];
        $model::create($data);

        return redirect()->route('admin.index', $section)->with('success', $config['title'] . ' created successfully.');
    }

    public function edit(Request $request, string $section, int $id)
    {
        if ($redirect = $this->guard($request)) {
            return $redirect;
        }

        $config = $this->resolveSection($section);
        $item = $config['model']::findOrFail($id);

        return view('admin.resource-form', [
            'title' => 'Edit ' . $config['title'],
            'section' => $section,
            'config' => $config,
            'item' => $item,
            'method' => 'PUT',
            'action' => route('admin.update', [$section, $id]),
        ]);
    }

    public function update(Request $request, string $section, int $id): RedirectResponse
    {
        if ($redirect = $this->guard($request)) {
            return $redirect;
        }

        $config = $this->resolveSection($section);
        $item = $config['model']::findOrFail($id);
        $data = $this->validatedData($request, $config, $item);

        $item->update($data);

        return redirect()->route('admin.index', $section)->with('success', $config['title'] . ' updated successfully.');
    }

    public function destroy(Request $request, string $section, int $id): RedirectResponse
    {
        if ($redirect = $this->guard($request)) {
            return $redirect;
        }

        $config = $this->resolveSection($section);
        $item = $config['model']::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.index', $section)->with('success', $config['title'] . ' deleted successfully.');
    }

    private function guard(Request $request): ?RedirectResponse
    {
        if (! $request->session()->get(self::SESSION_KEY)) {
            return redirect()->route('admin.login');
        }

        return null;
    }

    private function resources(): array
    {
        return [
            'products' => ['label' => 'Products', 'route' => route('admin.index', 'products')],
            'blog-posts' => ['label' => 'Blog Posts', 'route' => route('admin.index', 'blog-posts')],
            'success-stories' => ['label' => 'Success Stories', 'route' => route('admin.index', 'success-stories')],
            'site-images' => ['label' => 'Site Images', 'route' => route('admin.index', 'site-images')],
            'orders' => ['label' => 'Orders', 'route' => route('admin.index', 'orders')],
            'consultations' => ['label' => 'Consultations', 'route' => route('admin.index', 'consultations')],
        ];
    }

    private function resolveSection(string $section): array
    {
        return match ($section) {
            'products' => [
                'title' => 'Products',
                'model' => Product::class,
                'fields' => [
                    ['name' => 'name', 'label' => 'Name', 'type' => 'text'],
                    ['name' => 'category', 'label' => 'Category', 'type' => 'text'],
                    ['name' => 'price', 'label' => 'Price', 'type' => 'number', 'step' => '0.01'],
                    ['name' => 'image_url', 'label' => 'Image URL', 'type' => 'url'],
                    ['name' => 'image_file', 'label' => 'Upload Image', 'type' => 'file'],
                    ['name' => 'description', 'label' => 'Description', 'type' => 'textarea'],
                    ['name' => 'featured', 'label' => 'Featured', 'type' => 'checkbox'],
                    ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'number'],
                ],
                'columns' => ['name', 'category', 'price', 'featured', 'sort_order'],
                'supports_upload' => true,
                'rules' => [
                    'name' => ['required', 'string', 'max:160'],
                    'category' => ['required', 'string', 'max:160'],
                    'price' => ['required', 'numeric', 'min:0'],
                    'image_url' => ['nullable', 'string', 'max:2048'],
                    'image_file' => ['nullable', 'image', 'max:4096'],
                    'description' => ['nullable', 'string', 'max:2000'],
                    'featured' => ['sometimes', 'boolean'],
                    'sort_order' => ['sometimes', 'integer'],
                ],
            ],
            'blog-posts' => [
                'title' => 'Blog Posts',
                'model' => BlogPost::class,
                'fields' => [
                    ['name' => 'title', 'label' => 'Title', 'type' => 'text'],
                    ['name' => 'slug', 'label' => 'Slug', 'type' => 'text'],
                    ['name' => 'excerpt', 'label' => 'Excerpt', 'type' => 'textarea'],
                    ['name' => 'content', 'label' => 'Content', 'type' => 'textarea'],
                    ['name' => 'image_url', 'label' => 'Image URL', 'type' => 'url'],
                    ['name' => 'image_file', 'label' => 'Upload Image', 'type' => 'file'],
                    ['name' => 'author', 'label' => 'Author', 'type' => 'text'],
                    ['name' => 'published_at', 'label' => 'Published At', 'type' => 'datetime-local'],
                    ['name' => 'is_published', 'label' => 'Published', 'type' => 'checkbox'],
                    ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'number'],
                ],
                'columns' => ['title', 'author', 'is_published', 'published_at'],
                'supports_upload' => true,
                'rules' => [
                    'title' => ['required', 'string', 'max:200'],
                    'slug' => ['required', 'string', 'max:220'],
                    'excerpt' => ['required', 'string', 'max:500'],
                    'content' => ['required', 'string', 'max:10000'],
                    'image_url' => ['nullable', 'string', 'max:2048'],
                    'image_file' => ['nullable', 'image', 'max:4096'],
                    'author' => ['required', 'string', 'max:120'],
                    'published_at' => ['nullable', 'date'],
                    'is_published' => ['sometimes', 'boolean'],
                    'sort_order' => ['sometimes', 'integer'],
                ],
            ],
            'success-stories' => [
                'title' => 'Success Stories',
                'model' => SuccessStory::class,
                'fields' => [
                    ['name' => 'client_name', 'label' => 'Client Name', 'type' => 'text'],
                    ['name' => 'location', 'label' => 'Location', 'type' => 'text'],
                    ['name' => 'quote', 'label' => 'Quote', 'type' => 'textarea'],
                    ['name' => 'story', 'label' => 'Story', 'type' => 'textarea'],
                    ['name' => 'image_url', 'label' => 'Image URL', 'type' => 'url'],
                    ['name' => 'image_file', 'label' => 'Upload Image', 'type' => 'file'],
                    ['name' => 'is_featured', 'label' => 'Featured', 'type' => 'checkbox'],
                    ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'number'],
                ],
                'columns' => ['client_name', 'location', 'is_featured', 'sort_order'],
                'supports_upload' => true,
                'rules' => [
                    'client_name' => ['required', 'string', 'max:120'],
                    'location' => ['required', 'string', 'max:120'],
                    'quote' => ['required', 'string', 'max:500'],
                    'story' => ['required', 'string', 'max:2000'],
                    'image_url' => ['nullable', 'string', 'max:2048'],
                    'image_file' => ['nullable', 'image', 'max:4096'],
                    'is_featured' => ['sometimes', 'boolean'],
                    'sort_order' => ['sometimes', 'integer'],
                ],
            ],
            'site-images' => [
                'title' => 'Site Images',
                'model' => SiteImage::class,
                'fields' => [
                    ['name' => 'slot', 'label' => 'Slot', 'type' => 'select', 'options' => ['hero' => 'Hero', 'featured' => 'Featured', 'strip' => 'Strip', 'lookbook' => 'Lookbook']],
                    ['name' => 'title', 'label' => 'Title', 'type' => 'text'],
                    ['name' => 'image_url', 'label' => 'Image URL', 'type' => 'url'],
                    ['name' => 'image_file', 'label' => 'Upload Image', 'type' => 'file'],
                    ['name' => 'alt_text', 'label' => 'Alt Text', 'type' => 'text'],
                    ['name' => 'caption', 'label' => 'Caption', 'type' => 'text'],
                    ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox'],
                    ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'number'],
                ],
                'columns' => ['slot', 'title', 'is_active', 'sort_order'],
                'supports_upload' => true,
                'rules' => [
                    'slot' => ['required', 'string', 'max:80'],
                    'title' => ['required', 'string', 'max:160'],
                    'image_url' => ['nullable', 'string', 'max:2048'],
                    'image_file' => ['nullable', 'image', 'max:4096'],
                    'alt_text' => ['required', 'string', 'max:255'],
                    'caption' => ['nullable', 'string', 'max:255'],
                    'is_active' => ['sometimes', 'boolean'],
                    'sort_order' => ['sometimes', 'integer'],
                ],
            ],
            'orders' => [
                'title' => 'Orders',
                'model' => Order::class,
                'fields' => [
                    ['name' => 'full_name', 'label' => 'Full Name', 'type' => 'text'],
                    ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
                    ['name' => 'phone', 'label' => 'Phone', 'type' => 'text'],
                    ['name' => 'product_name', 'label' => 'Product Name', 'type' => 'text'],
                    ['name' => 'quantity', 'label' => 'Quantity', 'type' => 'number'],
                    ['name' => 'delivery_address', 'label' => 'Delivery Address', 'type' => 'text'],
                    ['name' => 'notes', 'label' => 'Notes', 'type' => 'textarea'],
                    ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['new' => 'New', 'processing' => 'Processing', 'fulfilled' => 'Fulfilled', 'cancelled' => 'Cancelled']],
                ],
                'columns' => ['full_name', 'product_name', 'quantity', 'status', 'created_at'],
                'supports_upload' => false,
                'rules' => [
                    'full_name' => ['required', 'string', 'max:120'],
                    'email' => ['required', 'email', 'max:120'],
                    'phone' => ['required', 'string', 'max:30'],
                    'product_name' => ['required', 'string', 'max:160'],
                    'quantity' => ['required', 'integer', 'min:1', 'max:100'],
                    'delivery_address' => ['required', 'string', 'max:255'],
                    'notes' => ['nullable', 'string', 'max:2000'],
                    'status' => ['required', 'string', 'max:40'],
                ],
            ],
            'consultations' => [
                'title' => 'Consultations',
                'model' => ContactInquiry::class,
                'fields' => [
                    ['name' => 'full_name', 'label' => 'Full Name', 'type' => 'text'],
                    ['name' => 'phone', 'label' => 'Phone', 'type' => 'text'],
                    ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
                    ['name' => 'space_type', 'label' => 'Space Type', 'type' => 'text'],
                    ['name' => 'vision', 'label' => 'Vision', 'type' => 'textarea'],
                ],
                'columns' => ['full_name', 'space_type', 'email', 'created_at'],
                'supports_upload' => false,
                'rules' => [
                    'full_name' => ['required', 'string', 'max:120'],
                    'phone' => ['required', 'string', 'max:30'],
                    'email' => ['required', 'email', 'max:120'],
                    'space_type' => ['required', 'string', 'max:80'],
                    'vision' => ['required', 'string', 'max:2000'],
                ],
            ],
            default => abort(404, 'Unknown admin section.'),
        };
    }

    private function validatedData(Request $request, array $config, $item = null): array
    {
        $validated = $request->validate($config['rules']);

        foreach (['featured', 'is_published', 'is_featured', 'is_active'] as $booleanField) {
            if (array_key_exists($booleanField, $validated) || $request->has($booleanField)) {
                $validated[$booleanField] = $request->boolean($booleanField);
            }
        }

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('admin-images', 'public');
            $validated['image_url'] = Storage::disk('public')->url($path);
        }

        if (isset($validated['slug']) && empty($validated['slug']) && ! empty($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if (isset($validated['published_at']) && $validated['published_at']) {
            $validated['published_at'] = date('Y-m-d H:i:s', strtotime($validated['published_at']));
        }

        if (($config['title'] ?? '') === 'Orders' && ! isset($validated['status'])) {
            $validated['status'] = $item?->status ?? 'new';
        }

        unset($validated['image_file']);

        return $validated;
    }
}
