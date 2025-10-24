import { Link } from "@inertiajs/react";
import { route } from "ziggy-js";
interface Comment {
id: number;
author_name: string;
content: string;
}
interface PostProps {
post: {
id: number;
title: string;
body: string;
user: { name: string };
comments: Comment[];
};
}
export default function Post({ post }) {
return (
<div>
<h1>{post.title}</h1>
<p>Autor: {post.user.name}</p>
<p>{post.body}</p>
<h3>Comentarios:</h3>
<ul>
{post.comments.map(c => (
<li key={c.id}>{c.author_name}: {c.content}</li>
))}
</ul>
</div>
);
}