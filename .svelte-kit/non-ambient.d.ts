
// this file is generated — do not edit it


declare module "svelte/elements" {
	export interface HTMLAttributes<T> {
		'data-sveltekit-keepfocus'?: true | '' | 'off' | undefined | null;
		'data-sveltekit-noscroll'?: true | '' | 'off' | undefined | null;
		'data-sveltekit-preload-code'?:
			| true
			| ''
			| 'eager'
			| 'viewport'
			| 'hover'
			| 'tap'
			| 'off'
			| undefined
			| null;
		'data-sveltekit-preload-data'?: true | '' | 'hover' | 'tap' | 'off' | undefined | null;
		'data-sveltekit-reload'?: true | '' | 'off' | undefined | null;
		'data-sveltekit-replacestate'?: true | '' | 'off' | undefined | null;
	}
}

export {};


declare module "$app/types" {
	type MatcherParam<M> = M extends (param : string) => param is (infer U extends string) ? U : string;

	export interface AppTypes {
		RouteId(): "/" | "/contact" | "/cv" | "/login" | "/login/basarili" | "/main" | "/mycity";
		RouteParams(): {
			
		};
		LayoutParams(): {
			"/": Record<string, never>;
			"/contact": Record<string, never>;
			"/cv": Record<string, never>;
			"/login": Record<string, never>;
			"/login/basarili": Record<string, never>;
			"/main": Record<string, never>;
			"/mycity": Record<string, never>
		};
		Pathname(): "/" | "/contact" | "/cv" | "/login" | "/login/basarili" | "/main" | "/mycity";
		ResolvedPathname(): `${"" | `/${string}`}${ReturnType<AppTypes['Pathname']>}`;
		Asset(): "/image/1.jpg" | "/image/2.jpg" | "/image/3.jpg" | "/image/4.jpg" | "/robots.txt" | string & {};
	}
}