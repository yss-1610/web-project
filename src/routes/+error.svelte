<script>
  import { page } from '$app/state';
  import { error } from '@sveltejs/kit';

  export function load() {
  throw error(404, 'Custom 404 message');
}
</script>

<h1>{$page.status}: {$page.error?.message || 'Page not found'}</h1>